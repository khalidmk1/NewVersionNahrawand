<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Interfaces\FAQInterface;
use App\Http\Controllers\Controller;

class FAQController extends Controller
{
    private $FAQInterface;

    public function __construct(FAQInterface $FAQInterface) {
        $this->FAQInterface = $FAQInterface;
    }
    public function FAQIndex(){
        return $this->FAQInterface->FAQIndex();
    }
}
