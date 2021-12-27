<table>
    <thead>
    <tr>
        <td>Name</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Email</td>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice['name'] }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ $invoice['email'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>