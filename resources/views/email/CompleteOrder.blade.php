<div style="background: #ecf0f1;text-align: center;padding: 30px;font-family: sans-serif;color: #444;">
    <div style="background-color: #fff;border-radius: 6px;padding: 1px;">
        <div style="margin: 5%;">   
            <h1>Data Science Weekend</h1>
            <p style="text-align: left;margin-top: 35px;line-height: 35px;">
                Thank you for purchased ticket {{ $ticket->name }} for {{ $event->title }}. Here the details :
            </p>
            <br /><br />
            <p style="text-align: left;margin-top: 35px;line-height: 35px;">
                <b>Event :</b> {{ $event->title }}<br />
                <b>Ticket Name :</b> {{ $ticket->name }}<br />
                <b>Status :</b> Paid
            </p>
            <br /><br />
            <p style="text-align: left;margin-top: 35px;line-height: 35px;">
                Regards,<br />
                Tim Data Science Weekend 2021
            </p>
        </div>
    </div>
</div>