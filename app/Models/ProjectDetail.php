<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProjectDetail extends Model
{
    protected $fillable = [
      'first_name', 'last_name', 'phone_number','project_id','email','recovery_mail','password','street_address','city',
      'zip','state','country','state_abrevation','status','payment_status','worker_name','gmb_listing_name','bussiness_id','category_id','store_code',
      'business_name','address_line_1','address_line_2','address_line_3','address_line_4','address_line_5','sub_locality','locality',
      'administrative_area','country_region','postal_code','latitude','longitude','primary_phone','additional_phones','website','primary_category',
      'additional_categories','sunday_hours','monday_hours','tuesday_hours','wednesday_hours','thursday_hours','friday_hours','saturday_hours','special_hours',
      'from_the_business','logo_photo','cover_photo','other_photos','labels','adwords_location_extensions_phone','amenities_wi_fi_wi_fi','highlights_women_led_is_owned_by_women',
      'credit_card_american_express','credit_card_master_card','credit_card_visa','place_page_urls_menu_link_url_menu','opening_date','creation_date', 'final_status',
      'payment_type','referred_by','payment_id', 'published'
    ];

    public function getFields()
    {
        return $this->fillable;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getProjectCreationDateAttribute()
    {
        return $this->creation_date ?  Carbon::parse($this->creation_date)->format('m-d-Y') : Carbon::now()->format('m-d-Y');
    }

    public function bussinessType()
    {
        return $this->belongsTo(\App\Models\BussinessType::class, 'bussiness_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function getFinalMappedData()
    {

        $data = [
            $this->store_code,
            $this->business_name,
            $this->address_line_1,
            $this->address_line_2,
            $this->address_line_3,
            $this->address_line_4,
            $this->address_line_5,
            $this->sub_locality,
            $this->locality,
            $this->administrative_area,
            $this->country_region,
            $this->postal_code,
            $this->latitude,
            $this->longitude,
            $this->primary_phone,
            $this->additional_phones,
            $this->website,
            $this->primary_category,
            $this->additional_categories,
            $this->sunday_hours,
            $this->monday_hours,
            $this->tuesday_hours,
            $this->wednesday_hours,
            $this->thursday_hours,
            $this->friday_hours,
            $this->saturday_hours,
            $this->special_hours,
            $this->from_the_business,
            $this->logo_photo,
            $this->cover_photo,
            $this->other_photos,
            $this->labels,
            $this->adwords_location_extensions_phone,
            $this->amenities_wi_fi_wi_fi,
            $this->highlights_women_led_is_owned_by_women,
            $this->credit_card_american_express,
            $this->credit_card_master_card,
            $this->credit_card_visa,
            $this->place_page_urls_menu_link_url_menu
      ];
        return $data;
    }
}
