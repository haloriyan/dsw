<div style="background: #ecf0f1;text-align: center;padding: 30px;font-family: sans-serif;color: #444;">
    <div style="background-color: #fff;border-radius: 6px;padding: 1px;">
        <div style="margin: 5%;">   
            <h1>Data Science Weekend</h1>
            <p style="text-align: left;margin-top: 35px;line-height: 35px;">
		Hello, {{ $user->name }}, you have to complete your payment in order to purchase {{ $ticket->name }} ticket
            </p>
            <br /><br />
            <a href="{{ route('user.myTicket') }}" style="background: #f65271;color: #fff;text-decoration: none;padding: 18px 35px;border-radius: 6px;">
                Complete My Order
            </a>
            <br /><br />
            <p style="text-align: left;margin-top: 35px;line-height: 35px;">
                Regards,<br />
                Tim Data Science Weekend 2021
            </p>
        </div>
    </div>
</div>
