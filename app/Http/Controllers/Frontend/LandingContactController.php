<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FromWhereList;
use App\Models\LandingPageContact;
use App\Models\LandingPageData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

class LandingContactController extends Controller
{

    public function index(Request $request)
    {
        $fromWhere = FromWhereList::orderBy('id', 'desc')->pluck("name", "id");
        $landingData = LandingPageData::where("type", ucfirst($request->type))->first();
        $keys = ["20+", "966+", "1+", "971+", "965+", "212+", "44+", "90+", "962+", "964+", "967+", "63+", "973+", "963+", "974+", "91+", "249+", "968+", "961+", "970+", "213+", "960+", "98+", "880+", "216+", "252+", "66+", "62+", "1+", "49+", "972+", "251+", "371+", "33+", "218+", "7+", "86+", "34+", "674+", "92+", "60+", "46+", "234+", "994+", "55+", "94+", "254+", "256+", "39+", "678+", "685+", "676+", "257+", "221+", "61+", "675+", "370+", "269+", "31+", "52+", "57+", "686+", "266+", "809+", "380+", "977+", "233+", "27+", "82+", "43+", "225+", "222+", "224+", "290+", "235+", "30+", "84+", "48+", "77+", "32+", "690+", "255+", "65+", "852+", "248+", "995+", "81+", "229+", "677+", "261+", "41+", "351+", "381+", "54+", "231+", "47+", "253+", "353+", "40+", "51+", "211+", "93+", "64+", "372+", "683+", "220+", "352+", "996+", "387+", "237+", "420+", "976+", "45+", "291+", "226+", "58+", "593+", "243+", "53+", "357+", "682+", "232+", "509+", "355+", "998+", "975+", "56+", "688+", "358+", "504+", "242+", "505+", "95+", "227+", "223+", "244+", "377+", "359+", "373+", "236+", "886+", "502+", "375+", "855+", "264+", "389+", "679+", "36+", "356+", "228+", "597+", "250+", "247+", "258+", "591+", "374+", "670+", "501+", "891+", "1767+", "673+", "423+", "1876+", "506+", "267+", "386+", "993+", "260+", "507+", "856+", "241+", "382+", "385+", "503+", "230+", "239+", "265+", "595+", "263+", "598+", "240+", "421+", "992+", "354+", "383+", "1671+", "245+", "853+", "262+", "850+", "680+", "692+", "379+", "1264+", "1684+", "1868+", "268+", "238+", "1721+", "691+"];
        if ($landingData) {
            return view('landing pages.index')->with([
                "fromWhere" => $fromWhere,
                "landingData" => $landingData,
                "keys" => $keys,
                "type" => ucfirst($request->type)
            ]);
        }

        return view('landing pages.not-found');
    }

    public function thanks(): JsonResponse
    {
        $thanks = LandingPageData::where("type", "action")->first(["thanks_title", "thanks_paragraph"]);
        return response()->json(
            $thanks
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function send(Request $request)
    {
        $inputs = $request->only(["name", "email", "phone_number", "how_can_help_you", "type"]);
        $inputs['how_can_help_you'] = json_decode($inputs['how_can_help_you']);
        $how_can_help_you = [];
        if (!empty($inputs['how_can_help_you'])) {
            foreach ($inputs['how_can_help_you'] as $el) {
                $how_can_help_you[] = $el->value;
            }
            $inputs['how_can_help_you'] = $how_can_help_you;
        }
        $landing = new LandingPageContact;
        $landing->name = $inputs['name'];
        $landing->phone_number = $inputs['phone_number'];
        $landing->email = $inputs['email'];
        $landing->from_where_id = $inputs['how_can_help_you'];
        $landing->type = $inputs['type'];
        $landing->save();
        $landing = LandingPageData::where("type", $inputs['type'])->first();
        if ($landing) {
            $details = [
                'to' => $inputs['email'],
                'subject' => $landing->email_subject,
                'template' => $landing->email_template,
            ];
            composeEmail($details['to'], $details['subject'], $details['template']);
        }
        return response()->json(["success" => true]);
    }


    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email",
            "phone_number" => "required",
            "from_where" => "required|exists:from_where_list,name"
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with("error", $validator->errors()->first());
        }

        $from_where = FromWhereList::where('name', $request->from_where)->first()->id;
        $tel = $request->key ." ". $request->phone_number;

        $landing = new LandingPageContact;
        $landing->name = $request->name;
        $landing->phone_number = $tel;
        $landing->email = $request->email;
        $landing->from_where_id = $from_where;
        $landing->type = $request->type;
        $landing->save();
        $landing = LandingPageData::where("type", $request->type)->first();
        if ($landing) {
            $details = [
                'to' => $request->email,
                'subject' => $landing->email_subject,
                'template' => $landing->email_template,
            ];
            composeEmail($details['to'], $details['subject'], $details['template']);
        }

        $landingData = LandingPageData::where("type", $request->type)->first();

        return redirect()->route('thank', $request->type)->with('message', 'Thank you, your request is sent successfully.');
    }

    public function thank($type)
    {
        $landingData = LandingPageData::where("type", $type)->first(["thanks_title", "thanks_paragraph"]);
        return view('landing pages.thank', [
            'landingData' => $landingData
        ]);
    }
}
