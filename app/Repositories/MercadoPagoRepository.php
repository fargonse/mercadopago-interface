<?php


namespace App\Repositories;

use App\Models\Preference;
use App\Models\User;
use App\Repositories\Interfaces\OnlinePaymentRepositoryInterface;
use MercadoPago;
use Exception;

class MercadoPagoRepository implements OnlinePaymentRepositoryInterface
{
    /**
     * @param Preference $preference
     * @param User $user
     * @throws Exception
     * @return string
     */
    public function get_link( Preference $preference, User $user): string
    {
        $client = $user->client;

        MercadoPago\SDK::setAccessToken($client->appToken->keys->access_token);

        $date = new \DateTime();
        $date->setTimezone(new \DateTimeZone('-4'));

        $payer = $this->getPayer($preference, $date);

        $items = $this->getItems($preference);

        $this->createMercadoPagoPreference($items, $payer, $preference);

        return $preference->link;
    }

    /**
     * @param Preference $preference
     * @param \DateTime $date
     * @return MercadoPago\Payer
     */
    protected function getPayer(Preference $preference, \DateTime $date): MercadoPago\Payer
    {
        $payer = new MercadoPago\Payer();

        $payer->name = $preference->payer->name;
        $payer->surname = $preference->payer->surname;
        $payer->email = $preference->payer->email;

        $payer->date_created = $date->format('Y-m-d\TH:i:sP');

        $payer->phone = array(
            "area_code" => "",
            "number" => $preference->payer->phone_number
        );

        $payer->identification = array(
            "type" => $preference->payer->identification_type,
            "number" => $preference->payer->identification_number
        );
        return $payer;
    }

    /**
     * @param Preference $preference
     * @return array
     */
    protected function getItems(Preference $preference): array
    {
        $items = [];
        foreach ($preference->items as $item) {
            $MPItem = new MercadoPago\Item();
            $MPItem->id = $item->custom_id;
            $MPItem->title = $item->title;
            $MPItem->quantity = $item->quantity;
            $MPItem->currency_id = $item->currency_id;
            $MPItem->unit_price = $item->unit_price;
            array_push($items, $item);
        }
        return $items;
    }

    /**
     * @param array $items
     * @param MercadoPago\Payer $payer
     * @param Preference $preference
     * @throws Exception
     * @return string
     */
    protected function createMercadoPagoPreference(array $items, MercadoPago\Payer $payer, Preference $preference): MercadoPago\Preference
    {
        $MPPreference = new MercadoPago\Preference();
        $MPPreference->items = $items;
        $MPPreference->payer = $payer;
        $MPPreference->external_reference = $preference->external_reference;
        $MPPreference->binary_mode = true;
        $MPPreference->save();

        $preference->link = $MPPreference->init_point;
        $preference->save();

        return $MPPreference;
    }
}
