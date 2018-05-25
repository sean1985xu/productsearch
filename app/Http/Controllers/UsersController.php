<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $userData = null;

    // Init data from api
    public function __construct() 
    {
    	$this->userData = collect(json_decode(file_get_contents('https://jsonplaceholder.typicode.com/users')));
    }

    public function index($page = 1, $orderBy = 'id')
    {
    	// Generate a list with the data that need to send back
        $filter = $this->userData->map(function ($user) {
            $result = array();
            $result['firstName'] = "";
			$result['lastName'] = "";
			$result['email'] = "";
			$result['website'] = "";
			$result['emailURL'] = "";
			$result['websiteURL'] = "";
            
            if (isset($user->name) && is_string($user->name)) {
				$nameArray = explode(" ", $user->name);
				$result['firstName'] = $nameArray[0];
				$result['lastName'] = isset($nameArray[1]) ? $nameArray[1] : "";
            }
            if (isset($user->email) && is_string($user->email))
            	$result['email'] = $user->email;
            if (isset($user->website) && is_string($user->website))
            	$result['website'] = $user->website;

            if (filter_var($result['email'], FILTER_VALIDATE_URL)) 
            	$result['emailURL'] = $result['email'];
            if (filter_var($result['website'], FILTER_VALIDATE_URL)) 
            	$result['websiteURL'] = $result['website'];
            
            return collect($result);
        });
        //sort the data and send back the data for this page
        $userList = $filter->sortBy($orderBy)->forPage($page, 5)->all();
        //pagenation
        $userList = $this->generatePagenation($userList, $page, sizeof($filter), 5);
        $userList['orderBy'] = $orderBy;
        return view('userList', compact('userList'));
    }

    // Pagenation for a data list
    public function generatePagenation($resultData, $current_page, $result_number, $size = 5, $max_show_page = null)
    {
        $max_show_page = isset($max_show_page) ? $max_show_page : 11;
        $all_pages = intval(ceil($result_number / $size));
        $current_page = intval(isset($current_page) ? $current_page : 1);
        $current_page = min(max(1, $current_page), $all_pages);

        $current_range_start = $current_page - round($max_show_page /2);
        $current_range_end = $current_range_start + $max_show_page;

        if ($current_range_start < 1) $current_range_end = $max_show_page;
        if ($current_range_end > $all_pages) $current_range_start = $all_pages - $max_show_page;

        $current_range_start = max(1, $current_range_start);
        $current_range_end = min($all_pages, $current_range_end);

        if (is_object($resultData))
        {
            $resultData->all_pages = $all_pages;
            $resultData->current_range_start = $current_range_start;
            $resultData->current_range_end = $current_range_end;
            $resultData->current_page = $current_page;
        } else {
            $resultData['all_pages'] = $all_pages;
            $resultData['current_range_start'] = $current_range_start;
            $resultData['current_range_end'] = $current_range_end;
            $resultData['current_page'] = $current_page;
        }

        return $resultData;
    }
}
