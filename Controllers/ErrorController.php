<?php


class ErrorController extends Controller
{

    public function notFound()
    {

        $this->returnView('404', $this->data);

    }

}