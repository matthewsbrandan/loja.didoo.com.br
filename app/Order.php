<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'fee',
        'client_name',
        'fee_value',
        'static_fee',
        'vatvalue',
        'payment_info',
        'mollie_payment_key',
        'whatsapp_phone',
        'table_number'
    ];

    public function restorant()
    {
        return $this->belongsTo(\App\Restorant::class);
    }

    public function driver()
    {
        return $this->hasOne(\App\User::class, 'id', 'driver_id');
    }

    public function table()
    {
        return $this->hasOne(\App\Tables::class, 'id', 'table_id');
    }

    public function address()
    {
        return $this->hasOne(\App\Address::class, 'id', 'address_id');
    }

    public function client()
    {
        return $this->hasOne(\App\User::class, 'id', 'client_id');
    }

    public function status()
    {
        return $this->belongsToMany(\App\Status::class, 'order_has_status', 'order_id', 'status_id')->withPivot('user_id', 'created_at', 'comment')->orderBy('order_has_status.id', 'ASC');
    }

    public function laststatus()
    {
        return $this->belongsToMany(\App\Status::class, 'order_has_status', 'order_id', 'status_id')->withPivot('user_id', 'created_at', 'comment')->orderBy('order_has_status.id', 'DESC')->limit(1);
    }

    public function stakeholders()
    {
        return $this->belongsToMany(\App\User::class, 'order_has_status', 'order_id', 'user_id')->withPivot('status_id', 'created_at', 'comment')->orderBy('order_has_status.id', 'ASC');
    }

    public function items()
    {
        return $this->belongsToMany(\App\Items::class, 'order_has_items', 'order_id', 'item_id')->withPivot(['qty', 'extras', 'vat', 'vatvalue', 'variant_price', 'variant_name']);
    }

    public function ratings()
    {
        return $this->belongsToMany(\App\Ratings::class, 'ratings', 'order_id', 'id');
    }

    public function getActionsAttribute()
    {
    }

    public function getSocialMessageAttribute($encode=false){
        $dnl="\n\n";
        $nl="\n\n";
        $tabSpace="      ";

        $message= __("Hi, I'd like to place an order")." 👇".$dnl;
        
        //Deliver method
        if($this->delivery_method==1){
            //Deliver
            $message.="🛵🔜🏡".$nl;
            $message.="*".__('Delivery Order No').": ".$this->id."*";
        }else if($this->delivery_method==4){
            // Table
            $message.="✅🏫".$nl;
            $message.="*".__('Order No').": ".$this->id."*\n";
            $message.="*".__('Table No').": ".$this->table_number."*";
        }else{
            //Pickup
            $message.="✅🏫".$nl;
            $message.="*".__('Pickup Order No').": ".$this->id."*";
        }

        // Client name
        if($this->client_name) $message.=" \n".__('Client name').": ".$this->client_name;
        //The order
        $message.=$nl."---------".$nl;
        foreach ($this->items()->get() as $key => $item) {
            $lineprice = $item->pivot->qty.' X '.$item->name." - ".money($item->pivot->qty * $item->pivot->variant_price, config('settings.cashier_currency'), true);
            if(strlen($item->pivot->variant_name)>3){
                $lineprice .=$nl.$tabSpace.__('Variant: '.$item->pivot->variant_name);
            }
           
            if(strlen($item->pivot->extras)>3){
                foreach (json_decode($item->pivot->extras) as $key => $extra) {
                    $lineprice .=$nl.$tabSpace.$extra;
                }
            }
            $message.="🔘".$lineprice.$nl;
        }
        $message.="---------".$nl;
        if($this->delivery_method==1 && $this->delivery_price > 0){
            $messageTotal = "🧾".__('Subtotal: ').money(
                $this->order_price, config('settings.cashier_currency'), true
            )."\n";
            $messageTotal.= "🧾".__('Delivery').": ".money(
                $this->delivery_price, config('settings.cashier_currency'), true
            )."\n";
            $messageTotal.= "🧾".__('Total: ').money(
                $this->order_price + $this->delivery_price, config('settings.cashier_currency'), true
            );

            $message.= $messageTotal;
        }
        else $message.="🧾".__('Total: ').money(
            $this->order_price, config('settings.cashier_currency'), true
        );
        // $message.="🧾".__('Total: ').money($this->order_price, config('settings.cashier_currency'), config('settings.do_convertion'));
        $message.=$nl."---------";
        if(strlen($this->comment)>0){
            //The comment
            $message.=$nl."🗒".__('Comment').$nl;
            $message.=$this->comment.$nl;
        }

         //Deliver / Pickup details
         if($this->delivery_method==1){
            //Deliver
            $message.="📍"." ".__('Delivery Details');
            $message.=$nl.__('Address').": ".$this->whatsapp_address;
            if(!strpos($this->comment,'*'.__('Scheduled to').'*')){
                $message.=$nl.__('Delivery time').": ".$this->getTimeFormatedAttribute();
            }
        }else{
            //Pickup
            $message.="✅".__('Pickup Details').$nl;
            if(!strpos($this->comment,'*'.__('Scheduled to').'*')){
                $message.=__('Pickup time').": ".$this->getTimeFormatedAttribute();
            }
        }

       
        $message.=$nl.$this->restorant->name." ".__('will confirm your order upon receiving the message.').$nl;

        // if($this->restorant->payment_info){
        //     //Payment
        //     $message.=$nl."💳".__('Payment Options').$nl;
            
        //     $payment_info = [];
        //     foreach(explode(',',$this->restorant->payment_info) as $pay){
        //         $payment_info[]= __($pay);
        //     }
        //     $message.= implode(', ',$payment_info);
        // }

        //Payment Link
       
        if(strlen($this->payment_link)>5){
            //Add the payment link
            $message.=$nl."💳".__('Pay now').$nl;
            $message.=$this->restorant->getLinkAttribute()."/?pay=".$this->id;
        }

        

        if($encode){
            $message= urlencode($message);
            return $message;
        }

       
        return $message;
    }

    public function getTimeFormatedAttribute()
    {
        $parts = explode('_', $this->delivery_pickup_interval);
        if (count($parts) < 2) {
            return '';
        }

        $hoursFrom = (int) (($parts[0] / 60).'');
        $minutesFrom = $parts[0] - ($hoursFrom * 60);

        $hoursTo = (int) (($parts[1] / 60).'');
        $minutesTo = $parts[1] - ($hoursTo * 60);

        $format = 'G:i';
        if (config('settings.time_format') == 'AM/PM') {
            $format = 'g:i A';
        }
        $from = date($format, strtotime($hoursFrom.':'.$minutesFrom));
        $to = date($format, strtotime($hoursTo.':'.$minutesTo));

        return $from.' - '.$to;
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function (self $order) {
            //Delete Order items
            $order->items()->detach();
            
            //Delete Oders statuses
            $order->status()->detach();

            //Delete Oders ratings
            $order->ratings()->detach();

            return true;
        });
    }
}
