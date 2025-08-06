<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Helper;
use App\Models\Membership;
use App\Models\UserMission;
use Illuminate\Http\Request;

class MissionController extends Controller
{

    private $model;

    public function __construct(Membership $model)
    {
        $this->model = $model;
    }

    public function list(Request $request)
    {
        return response()->json([
            [
                'title' => "Chương trình Nâng Hạng Thành Viên",
                'data' => [
                    $this->misssion(
                        1,
                        "Chương trình Nâng Hạng Thành Viên (" . auth()->user()->point . ")",
                        [
                            "steps" => [
                                0, 100, 500, 1000, 2000, 5000
                            ],
                            "points" => [
                                0, 100, 500, 1000, 2000, 5000
                            ],
                        ],
                        auth()->user()->point,
                        null
                    )

                ]
            ]
        ]);
    }

    public function create(Request $request)
    {

        switch ($request->id) {
            case 1:
                $point = $this->misssion(
                    1,
                    "Chương trình Nâng Hạng Thành Viên (" . auth()->user()->point . ")",
                    [
                        "steps" => [
                            0, 100, 500, 1000, 2000, 5000
                        ],
                        "points" => [
                            0, 100, 500, 1000, 2000, 5000
                        ],
                    ],
                    auth()->user()->point,
                    null,
                    true
                );
                if ($point > 0) {
                    auth()->user()->addPoint($point, "Chương trình Nâng Hạng Thành Viên :" . $this->getStepByPoint([
                            0, 100, 500, 1000, 2000, 5000
                        ], $point));
                    return response()->json([
                        'message' => "Bạn vừa nhận được " . $point . " điểm",
                        'code' => 200,
                    ]);
                } else {
                    goto notEnough;
                }
                break;
        }

        notEnough:
        return response()->json(Helper::errorAPI(99, [], "Bạn chưa đủ điều kiện"), 400);
    }

    private function misssion($missionID, $title, $stepID, $currentStep, $expired, $isTakenMission = null, $from = null, $to = null)
    {

        $takenPoint = 0;

        $point = 0;
        $isReceived = false;
        $indexed = 0;
        $require = 0;

        foreach ($stepID['steps'] as $index => $step) {
            $indexed = $index;
            $point = $stepID['points'][$index];

            $require = $step;
            if ($currentStep < $step) {
                break;
            } else {
                if ($point > 0) {
                    $userMission = UserMission::where(['user_id' => auth()->id(), 'mission_id' => $missionID, 'step' => $step]);

                    if (!empty($from)) {
                        $userMission->whereDate('created_at', '>=', $from);
                    }

                    if (!empty($to)) {
                        $userMission->whereDate('created_at', '<=', $to);
                    }

                    $UserMission = $userMission->first();
                    $isReceived = empty($UserMission);
                }
            }
        }

        if ($isTakenMission) {
            foreach ($stepID['steps'] as $index => $step) {
                if ($indexed >= $index) {
                    $point = $stepID['points'][$index];
                    if ($point > 0) {
                        if ($currentStep >= $step) {
                            $userMission = UserMission::where(['user_id' => auth()->id(), 'mission_id' => $missionID, 'step' => $step]);

                            if (!empty($from)) {
                                $userMission->whereDate('created_at', '>=', $from);
                            }

                            if (!empty($to)) {
                                $userMission->whereDate('created_at', '<=', $to);
                            }

                            $userMission = $userMission->first();

                            $isReceived = !empty($userMission);

                            if (!$isReceived) {
                                UserMission::create(['user_id' => auth()->id(), 'mission_id' => $missionID, 'step' => $step]);
                                $takenPoint += $point;
                            }
                        }
                    }
                } else {
                    break;
                }
            }

            return $takenPoint;
        }

        return [
            "id" => $missionID,
            "title" => $title,
            "require" => $require,
            "current" => $currentStep ?? 0,
            "point" => $point,
            "expired" => $expired,
            "is_received" => $isReceived,
            "steps_points" => $stepID
        ];
    }

    public function getStepByPoint($steps, $point)
    {
        foreach ($steps as $step) {
            if ($point <= $step) {
                return $step;
            }
        }

        return $steps[count($steps) - 1];
    }
}
