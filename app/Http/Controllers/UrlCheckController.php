<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class UrlCheckController extends Controller
{
    public function store($id)
    {
        $url = DB::table('urls')->find($id);

        if (empty($url)) {
            return abort(404);
        }

        try {
            $response = Http::get($url->name);
        } catch (\Exception $e) {
            flash('Url адресс не существует')->error()->important();
            return redirect()->route('urls.show', $url->id);
        }

        $urlChecks = [
            'url_id' => $url->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('urls')
            ->where('id', $url->id)
            ->update(['updated_at' => Carbon::now()]);

        DB::table('url_checks')
            ->insert($urlChecks);

        flash('Страница успешно проверена ')->info()->important();
        return redirect()->route('urls.show', $url->id);
    }
}
