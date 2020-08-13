<h1>Entrance QRCode of {{ $companyEvent->name }}</h1>
<p>Here is your event entrance generated code, enjoy and stay in touch !</p>
<p>
    <img alt="Embedded Image"
         src="{{ $message->embed($qrCode->writeDataUri()) }}"
         width="200" height="200"/>
</p>
<p><a href="/itravel.ist" target="_blank">iTravel.ist</a></p>
<img alt="Company Logo" src="https://itravel.ist/wp-content/uploads/2020/03/g1016.png">