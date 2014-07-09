<?php

class BabiesController extends BaseController
{
    protected $layout = 'layouts.default';

    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('jsondenied', ['except' => ['getIndex', 'getDetail']]);
        $this->beforeFilter('auth', ['only' => ['getIndex', 'getDetail']]);
    }

    /**
     * GET  /babies/index
     */
    public function getIndex()
    {
        $this->layout->title = 'ทะเบียนเด็กแรกเกิด';
        $this->layout->content = View::make('babies.index');
    }
} 