<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class UrlController extends Controller
{
    /**
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $urls = DB::table('urls')
            ->paginate(30);

        $lastChecks = DB::table('url_checks')
            ->select('url_id', 'status_code', DB::raw('MAX(url_checks.updated_at) as last_check'))
            ->groupBy('url_id', 'status_code')
            ->get();

        $lastUrlChecks = $lastChecks->keyBy('url_id');

        return view('url.index', compact('urls', 'lastUrlChecks'));
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('url.create');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url.name' => 'required|url'
        ]);

        if ($validator->fails()) {
            flash('Некорректный URL')->error()->important();
            return redirect()->route('urls.create');
        }

        $url = $request->input('url');
        $urlParsed = parse_url($url['name']);
        $name = strtolower("{$urlParsed['scheme']}://{$urlParsed['host']}");

        $currentId = DB::table('urls')
            ->where('name', $name)
            ->value('id');

        if ($currentId === null) {
            flash('URL уже существует')->info()->important();
            return redirect()->route('urls.show', ['id' => $currentId]);
        }

        $url = [
            'name' => $name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $newId = DB::table('urls')->insertGetId($url);

        flash('URL успешно добавлен')->info()->important();
        return redirect()->route('urls.show', ['id' => $newId]);
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        $url = DB::table('urls')->find($id);

        if ($url === null) {
            abort(404);
        }

        $urlChecks = DB::table('url_checks')
            ->where('url_id', $url->id)
            ->get()
            ->sortDesc();

        return view('url.show', compact('url', 'urlChecks'));
    }
}
