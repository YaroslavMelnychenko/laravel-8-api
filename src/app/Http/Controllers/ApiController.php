<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Http\File;

use App\Http\Response;
use App\Jobs\TestJob;

class ApiController extends Controller
{
    public function index() {
        return Response::send([
            'error' => false,
            'message' => 'This is laravel api'
        ], 'SUCCESS');
    }

    public function testRedis() {
        $redis = Redis::connection();

        $redis->set('test', 'Connection successful');

        return Response::send([
            'error' => false,
            'message' => $redis->get('test')
        ], 'SUCCESS');
    }

    public function testStorage() {
        $tmp = tmpfile();
        fwrite($tmp, 'this is a test file');

        $file = new File(stream_get_meta_data($tmp)['uri']);

        $path = Storage::cloud()->putFile('test', $file);

        return Response::send([
            'error' => false,
            'message' => config('filesystems.cloud_path').'/'.$path
        ], 'SUCCESS');
    }

    public function testJob($delay) {
        TestJob::dispatch()->delay(now()->addSeconds($delay));

        return Response::send([
            'error' => false,
            'message' => 'Job dispatched'
        ], 'SUCCESS');
    }
}
