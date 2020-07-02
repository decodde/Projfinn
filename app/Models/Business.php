<?php

namespace App\Models;

use App\Http\Helpers\sendMail;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    //
    protected $table = 'businesses';

    protected $fillable = ['userId', 'categoryId', 'name', 'email', 'phone', 'address', 'website', 'bio', 'logo', 'startDate', 'size', 'country', 'state', 'cac', 'approvedAt', 'slug', 'financialRaise', 'turnoverAmount', 'turnoverPercent', 'score', 'nextOnline', 'matching', 'isDeleted'];

    protected $hidden = [
        'website', 'bio', 'updated_at', 'startDate', 'state', 'cac', 'approvedAt', 'financialRaise', 'turnoverAmount', 'turnoverPercent', 'nextOnline', 'matching'
    ];
    public function category() {
        return $this->hasOne('App\Models\Category', 'id', 'categoryId');
    }

    public function score($businessId = null) {
        if(!$businessId) {
            return $this->hasMany('App\Models\Eligibility', 'businessId', 'id');
        } else {
            return Eligibility::where('businessId', $businessId)->first();
        }
    }

    public function owner() {
        return $this->hasOne('App\Models\User', 'id', 'userId')->first();
    }

    public function account() {
        return $this->hasOne('App\Models\busAccount', 'userId', 'userId')->first();
    }

    public function guarantors() {
        return $this->hasMany('App\Models\Guarantor', 'businessId', 'id');
    }

    public function documents() {
        return $this->hasMany('App\Models\Document', 'businessId', 'id')->get();
    }

    public function bvn() {
        return $this->hasOne('App\Models\BVN', 'businessId', 'id');
    }

    public function matches() {
        return $this->hasMany('App\Models\Match', 'businessId', 'id');
    }

    public function profilePercentage($businessId, $score) {
        $query = Business::where('id', $businessId);

        if($query->value('score') < 50) {
            $query->increment('score', $score);

            if($query->value('score') == 30 || $query->value('score') == 50) {
                //send mail to admin from here
                sendMail::notifyAdminBusinessProfileCompleted($query->first());
            }
        }

        return true;
    }

    public function reduceProfilePercentage($businessId, $score) {
        Business::where('id', $businessId)->decrement('score', $score);
    }

    public function purge($businessId) {
        //delete eligibility
        Eligibility::where('businessId', $businessId)->delete();

        //delete all uploaded document records
        Document::where('businessId', $businessId)->delete();

        //delete all the BVN they stored on the platform
        BVN::where('businessId', $businessId)->delete();

        //delete the guarantors they are associated with
        Guarantor::where('businessId', $businessId)->delete();

        //delete all match histories
        Match::where('businessId', $businessId)->delete();

        return true;
    }
}
