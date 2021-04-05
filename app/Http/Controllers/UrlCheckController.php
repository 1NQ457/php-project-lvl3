<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use DiDom\Document;

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

        $bodyHtml = $response->body();

        $document = new Document($bodyHtml);

        $h1 = $document->has('h1') ? $document->first('h1')->text() : null;
        $keywords = $document->has('meta[name="keywords"]')
            ? $document->first('meta[name="keywords"]')->getAttribute('content')
            : null;
        $description = $document->has('meta[name="description"]')
            ? $document->first('meta[name="description"]')->getAttribute('content')
            : null;


        $urlChecks = [
            'status_code' => $response->status(),
            'h1' => $h1,
            'keywords' => $keywords,
            'description' =>  $description,
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
