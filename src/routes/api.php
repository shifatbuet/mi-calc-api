<?php

Route::post('calculate', 'CalculatorController@calculate')->middleware('cors');
