<?php

namespace App\Http\Helpers;

class partials{
    public function formatErrors($messages)
    {
        $errors = [];
        foreach ($messages as $key => $value) {
            array_push($errors, $value);
        }

        return $errors;
    }

    public function saveExpiryTime($token)
    {
        //get current time in hours
        $currentTime = date("H:i");

        //add 20 mins to the current time to make the link expire after 20mins
        //the timeout is configurable with env variables, you can just replace
        //the value with the variable of your choice.
        $expiryTime = date('H:i',strtotime('+20 minutes',strtotime($currentTime)));

        //store the values in an array
        $timeData = [
            'token' => $token,
            'time'  => $expiryTime,
        ];

        return $timeData;
    }

    public function sizes() {
        return ['1-5','6-10','11-20','21-50','50-100','100+'];
    }

    public function loanBand() {
        return ['100,000-500,000', '600,000-1,000,000', '1,100,000-2,000,000', '2,000,000-5,000,000'];
    }

    public function minimumYears() {
        return ['0-2', '2-5', '6-10', '10+'];
    }

    public function interestRates() {
        return ['1-5%', '6-10%', '11-15%', '16-20%', '21-25%', '26-30%', '31-35%', '36-40%'];
    }

    public function durations() {
        return ['monthly', 'quaterly', 'annually', 'termly'];
    }

    public function eligibilityOptions($option = null) {
        $options = [
            'registrationStatus' => [
                [
                    'id' => 1,
                    'name' => 'Limited liability',
                    'score' => 10,
                ],
                [
                    'id' => 2,
                    'name' => 'Partnership',
                    'score' => 5,
                ],
                [
                    'id' => 3,
                    'name' => 'Business name',
                    'score' => 5,
                ],
                [
                    'id' => 4,
                    'name' => 'Not registered',
                    'score' => 0,
                ],
            ],

            'yearsOfRunning' => [
                [
                    'id' => 1,
                    'name' => '0 - 6months',
                    'score' => 0,
                ],
                [
                    'id' => 2,
                    'name' => '12 - 18months',
                    'score' => 5,
                ],
                [
                    'id' => 3,
                    'name' => '18months - 3years',
                    'score' => 10,
                ],
                [
                    'id' => 4,
                    'name' => 'Over 3years',
                    'score' => 15,
                ],
            ],

            'lastBusinessRevenue' => [
                [
                    'id' => 1,
                    'name' => 'Yes',
                    'score' => 10,
                ],
                [
                    'id' => 2,
                    'name' => 'No',
                    'score' => 0,
                ],
            ],

            'accountVerifiable' => [
                [
                    'id' => 1,
                    'name' => 'Yes',
                    'score' => 10,
                ],
                [
                    'id' => 2,
                    'name' => 'No',
                    'score' => 0,
                ]
            ],

            'turnover' => [
                [
                    'id' => 1,
                    'name' => 'Over 90% of revenue',
                    'score' => 10,
                ],
                [
                    'id' => 2,
                    'name' => 'Over 70% of revenue',
                    'score' => 5,
                ],
                [
                    'id' => 3,
                    'name' => 'Less than 70% of revenue',
                    'score' => 0,
                ],
            ],

            'financingRaise' => [
                [
                    'id' => 1,
                    'name' => '#100,000-#500,000',
                    'score' => 10,
                ],
                [
                    'id' => 2,
                    'name' => '#600,000-#1,000,000',
                    'score' => 5,
                ],
                [
                    'id' => 3,
                    'name' => '#1,100,000 - #2,000,000',
                    'score' => 5,
                ],
                [
                    'id' => 4,
                    'name' => '#2,000,000 - #5,000,000',
                    'score' => 5,
                ],
                [
                    'id' => 5,
                    'name' => 'Over #5,000,000',
                    'score' => 5,
                ],
            ],
        ];

        if($option) {
            foreach($options as $key => $thisOption) {
                if($key == $option) {
                    return json_decode(json_encode($thisOption));
                }
            }
        } else {
            return json_decode(json_encode($options));
        }


    }

    public function gradeScore($score = null) {
        $grade = null;

        if($score <= 20 && $score !== null) {
            $grade = ['grade' => 'C', 'remark' => 'You\'re not eligible for a loan at this time', 'color' => 'brown'];
        } elseif($score >= 21 && $score < 30) {
            $grade = ['grade' => 'B', 'remark' => 'You\'re close to being eligible for a loan', 'color' => 'blue'];
        } elseif($score >= 30) {
            $grade = ['grade' => 'A', 'remark' => 'You\'re very eligible to apply for a loan to fund your business', 'color' => 'green'];
        } else {
            $grade = ['grade' => 'N/A', 'remark' => 'Not available', 'color' => 'black'];
        }

        return (object)$grade;
    }

    public function getDateDifference($date1, $date2) {
        $presentMonth = date('m', strtotime($date2));
        $pastMonth = date('m', strtotime($date1));

        $presentDay = date('d', strtotime($date2));
        $pastDay = date('d', strtotime($date1));

        $presentYear = date('y', strtotime($date2));
        $pastYear = date('y', strtotime($date1));

        $diffInMonths = $presentMonth - $pastMonth;
        $diffInDays = $presentDay - $pastDay;
        $diffInYears = $presentYear - $pastYear;

        $difference = ['years' => $diffInYears, 'months' => $diffInMonths, 'days' => $diffInDays];

        return (object) $difference;
    }

    public function states($param = null) {
        $getStates = json_decode(file_get_contents(storage_path('app/states.json')), true);
        $states = [];

        foreach ($getStates as $key => $state) {
            $state = $state['state'];

            $data = [
                'stateName' => $state['name'],
                'stateId' => $state['id'],
            ];

            if($param && ($data['stateId'] == $param || $data['stateName'] == $param)) {
                $getLGAs = $state['locals'];
                $lgas = [];

                for ($i=0; $i < count($getLGAs); $i++) {
                    array_push($lgas, $getLGAs[$i]['name']);
                }

                return $lgas;

            } else {
                array_push($states, $data);
            }
        }

        return $states;
    }

    public function percentageDifference($num1, $num2) {
        if($num2 > $num1) {
            $difference = $num2 - $num1;
            $num = $num2;
        } elseif($num1 > $num2) {
            $difference = $num1 - $num2;
            $num = $num1;
        } elseif($num1 == $num2) {
            return 100;
        }

        $percentageDifference = ($difference / $num) * 100;

        return round($percentageDifference);
    }

    public static function str_rand($str) {
        $string = explode('e', $str);

        $randomize = array_flip($string);

        return implode($randomize);

        // array
    }

    public function credits($id = null) {
        $credits = [
            [
                'name' => 'Single Access',
                'description' => 'Unlock a single business',
                'amount' => 5000,
                'credit' => 5,
                'id' => 'basic'
            ],
            [
                'name' => 'Bulk Access',
                'description' => 'Unlock 10 businesses',
                'amount' => 25000,
                'credit' => 50,
                'id' => 'gold',
            ],
        ];

        if($id) {
            foreach($credits as $credit) {
                if($credit['id'] == $id) {
                    return (object) $credit;
                }
            }
        } else {
            return (object) $credits;
        }
    }

    public function getPercentage($percentage, $value) {
        $result = $percentage * $value / 100;

        return $result;
    }

    public function checkRange($arr1, $arr2) {
        if(is_array($arr2)) {
            if(count($arr1) == 2) {
                $valueArr1a = $arr1[0];
                $valueArr1b = $arr1[1];
            } else {
                $valueArr1a = $arr1[0];
                $valueArr1b = 0;
            }

            if(count($arr2) == 2) {
                $valueArr2a = $arr2[0];
                $valueArr2b = $arr2[1];
            } else {
                $valueArr2a = $arr2[0];
                $valueArr2b = 0;
            }

            $percentageRange = $this->getPercentage(env('PERCENTAGE_INCREASE'), $valueArr2b);
            $rangeMax = $valueArr2a + $percentageRange;
            // dd([$valueArr1a, $valueArr1b], [$valueArr2a, $valueArr2b], $percentageRange, $rangeMax);
            if($valueArr1a >= $valueArr2a && $valueArr1a <= $rangeMax){
                return true;
            } elseif($valueArr2a >= $valueArr1a && $valueArr1a <= $rangeMax) {
                return true;
            } else {
                return false;
            }
        } else {
            $percentageRange = $this->getPercentage(env('PERCENTAGE_INCREASE'), $arr1[1]);
            $rangeMax = $arr1[1] + $percentageRange;

            if($arr2 >= $arr1[0] && $arr2 <= $rangeMax) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function guarantorsRelationhip() {
        return ['My mentor', 'Past client', 'My Parent', 'My Sibling', 'A close friend'];
    }

    public function documentTypes() {
        return ['bank statements', 'cac', 'utility bills'];
    }

    public function profilePercentage($bvn, $guarantors, $documents, $test) {
        $score = 0;

        if($test) {
            $score += 10;
        }

        if($bvn) {
            $score += 10;
        }

        $guarantorsCount = $guarantors->count();
        if($guarantorsCount == 1) {
            $score += 5;
        } elseif ($guarantorsCount == 2) {
            $score += 10;
        }

        $documentsCount = $documents->count();
        if($documentsCount == 1) {
            $score += 5;
        } elseif($documentsCount == 2) {
            $score += 10;
        }

        return $score;
    }

    public function loanTypes($portfolio){
        switch ($portfolio) {
            case 'working capital portfolio':
                return [
                    "3" => 5,
                    "6" => 12,
                    "9" => 21,
                    "12" => 30
                ];
            case 'asset finance portfolio':
                return [
                    "3" => 3.5,
                    "6" => 8,
                    "9" => 14,
                    "12" => 20
                ];
            default:
                # code...
                break;
        }
    }

    public function interestSavings($i){
        switch ($i) {
            case '3':
                return 3;
            case '6':
                return 6.5;
            case '9':
                return 11;
            case '12':
                return 15;
            default:
                # code...
                break;
        }
    }
}
