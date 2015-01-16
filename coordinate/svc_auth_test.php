<?php
/* test the svc_auth class */

require 'svc_auth.php'; //Constructor handles obj creation and authorization.

$sa = new svc_auth();

$sa->service->jobs->listJobs(TEAM_ID);
echo 'Back from auth module...<br>';
var_dump($res);