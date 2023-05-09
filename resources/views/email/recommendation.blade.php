<p>Hello,</p>

<p>Here are some recommendations for your {{ $item->item_category }}:</p>

<ul>
    @foreach(explode(',', $recommendations) as $recommendation)
        <li>{{ trim($recommendation) }}</li>
    @endforeach
</ul>

<p>Thank you for using our service.</p>
