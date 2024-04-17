<?php

/* This file is part of Jeedom.
*
* Jeedom is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* Jeedom is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
*/

require_once __DIR__ . "/../../../../core/php/core.inc.php";
$headers = apache_request_headers();
$body = json_decode(file_get_contents('php://input'), true);

$plugin = plugin::byId('crm');
if (!$plugin->isActive()) {
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode(array());
    die();
}

if(isset($body['apikey']) && isset($body['request'])){
    if (!jeedom::apiAccess($body['apikey'], 'crm')) {
        header('HTTP/1.1 401 Unauthorized');
        echo json_encode(array());
        die();
    }
    $body = $body['request'];
} else {
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode(array());
    die();
}

header('Content-type: application/json');


switch ($body['action']) {
    case 'getContact':
        //$contact = crm::getContact($body['id']);
        $contact = array(
            'id'  => '1',
            'name'  => 'John Doe',
            'email'  => 'truc1@jeedom.com',
            'phone'  => '0123456789',
            'mobile' => '0123456789',
            'address' => '1 rue de la paix',
            'zip' => '75000',
            'city' => 'Paris',
            'country' => 'France',
            'company' => 'Jeedom'
        );
        echo json_encode($contact);

        break;
}       
