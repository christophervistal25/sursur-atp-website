<?php

    if(! function_exists('stage_asset') ) {
        function stage_asset($path , $secure = null)
        {
            if(config('app.env') === 'production') {
                return app('url')->asset('public/' . $path, $secure);
            } 
            return app('url')->asset($path, $secure);
        }
    }