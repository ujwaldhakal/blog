<?php

namespace App\Http\Controllers;

use App\Ai;
use App\OrderSession;
use Illuminate\Http\Request;

class AiController extends Controller
{
    protected $request;
    protected $abaKgarne;
    protected $errorBag;
    protected $orderSession;
    protected $isCustomSearch;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->abaKgarne = new Ai();
        $this->orderSession = new OrderSession();
        $this->checkUserSessionOnDb();

    }

    public function index()
    {
        $botQuestion = $this->request->get('bot_response');
        $userAnswer = $this->request->get('user_response');
        $whatsNext = $this->abaKgarne->WhatToDo($botQuestion)->first();
        if (!$whatsNext) {
            $whatsNext = $this->makeCustomSearch();
        }
        $this->process($whatsNext->getAction());
        return 'processing done';
    }

    public function makeCustomSearch()
    {
        $this->isCustomSearch = true;
        $aiKnowledgeList = $this->abaKgarne->all();
        foreach ($aiKnowledgeList as $knowledge) {
            if (str_contains($this->request->get('bot_response'), $knowledge->getQuestion())) {
                return $knowledge;
            }
        }
    }

    public function process($action)
    {
        switch ($action) {

            case 'beer_type':
                $this->orderSession->update(['beer_type' => $this->request->get('user_response')]);
                $this->learn($action);
                break;

            case 'order_quantity':
                $quantity = (int)filter_var($this->request->get('user_response'), FILTER_SANITIZE_NUMBER_INT);
                if (is_int($quantity)) {
                    $this->orderSession->update(['order_quantity' => $quantity]);
                } else {
                    $this->errorBag = 'We only accept value in numbers only';
                }
                $this->learn($action);

                break;

            case 'confirmation':
                $this->orderSession->update(['confirmation' => strtolower($this->request->get('user_response'))]);
                $this->learn($action);
                break;


        }
    }

    public function getOrderableQuantity()
    {
        return $this->orderSession->getOrderQuantity();
    }

    public function checkUserSessionOnDb()
    {
        $userId = '123';
        $orderSession = new OrderSession();
        $orderSession->user($userId);
        if (!$orderSession->count()) {
            $this->orderSession = $orderSession->create(['uid' => 123]);
        } else {
            $this->orderSession = $this->orderSession->user($userId)->first();
        }
    }

    public function learn($action)
    {
        if ($this->isLearnAble()) {
            $ai = new Ai();
            $ai->create(['question' => $this->request->get('bot_response'),
                'action_to_do' => $action]);
        }
    }

    public function isLearnAble()
    {
        return (bool)$this->isCustomSearch;
    }

}
