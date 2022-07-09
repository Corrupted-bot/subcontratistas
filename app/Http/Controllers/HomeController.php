<?php
// Copyright (c) Microsoft Corporation.
// Licensed under the MIT License.

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class HomeController extends Controller
{
  public function welcome()
  {

    $viewData = $this->loadViewData();
    try {
        $viewData['userEmail'] = $viewData['userEmail'];
        return view('welcome', $viewData);
    } catch (\Throwable$th) {
        return redirect("/");
    }

  }
}