<h1>Entrance of {{ $companyEvent->name }}</h1>
<p>Here is your event entrance generated code, enjoy it and let's keep in touch !</p>
<p>
    <img alt="Embedded QrCode Image"
         src="{{ $message->embed($qrCode->writeDataUri()) }}"
         width="200" height="200">
</p>
<small>Note that this entrance is for 1(one) person</small>
<br>
<a href="/itravel.ist" target="_blank">
    <img alt="Company Logo"
         src="https://itravel.ist/wp-content/uploads/2020/03/g1016.png"
         height="75" width="auto">
</a>
<br>
<a style="font-size: 8px;"
   href="https://docs.google.com/forms/d/1RQXRPlYzogUixAgPT3gWcoT30MDEEb3jezMH8o9EYbE/">Unsubscribe
</a>