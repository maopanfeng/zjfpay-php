<?php

require __DIR__.'/log.php';

Log::write('notify',$_POST, ['time'=>date('Y-m-d H:i:s')]);
echo 'fail';