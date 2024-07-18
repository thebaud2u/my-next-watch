<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Carbon\Carbon;

use Auth;
use DB;

use App\Enums\CompanyStatesEnum;
use App\Enums\PostStatesEnum;

use App\Models\Company;
use App\Models\MailLog;
use App\Models\Mediable;
use App\Models\Media;
use App\Models\Offer;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserLanguage;

use App\Models\CompanyResponse;
use App\Models\PostResponse;
use App\Models\PostResponseType;

use App\Models\ResponseType;
use App\Models\Response;

use Spatie\Permission\Models\Permission;

class TempController extends Controller
{
	public function test()
	{

	}

	public function script($code)
	{
		if($code == 'gghrMgcSPFS6UdQiuV92') {

		}
	}
}
