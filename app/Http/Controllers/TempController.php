<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Cmgmyr\Messenger\Models\{Participant, Thread};

use App\Enums\{AlertTypes, ArticleStates, ModerationStates, PublicationStates, ResponseStates};

use App\Models\{
	Activity, ActivityCategory, Admin, Alert, Article, ArticleAuthor, ArticleTag,
	City, Company, Country,
	Offer,
	MailLog, Message, Moderation,
	Post, PostType,
	ReadNotification, Response,
	Section, Subscription, SubSection,
	User
};

class TempController extends Controller
{
	public function script($code, $data = null)
	{
		if($code == 'OiVFKuUHe3fNOKRNF7Uq') {

		}
		elseif($code == 'GQu9auFvlcxA5IXGAASH') {

		}
		elseif($code == 'A6ZeEpt6fpDfIkBP7USk') {

		}
	}
}
