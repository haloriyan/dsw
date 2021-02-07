<div style="background: #ecf0f1;text-align: center;padding: 30px;font-family: sans-serif;color: #444;">
    <div style="background-color: #fff;border-radius: 6px;padding: 1px;">
        <div style="margin: 5%;">   
            <h1>Data Science Weekend</h1>
            <p style="text-align: left;margin-top: 35px;line-height: 35px;">
                Terima kasih telah membeli tiket {{ $ticket->name }} untuk event {{ $event->title }}. Berikut adalah detail order tiket Anda
            </p>
            <br /><br />
            <p style="text-align: left;margin-top: 35px;line-height: 35px;">
                <b>Event :</b> {{ $event->title }}<br />
                <b>Nama Tiket :</b> {{ $ticket->name }}<br />
                <b>Status :</b> Lunas
            </p>
            <br /><br />
            <p style="text-align: left;margin-top: 35px;line-height: 35px;">
                Regards,<br />
                Tim Data Science Weekend 2021
            </p>
        </div>
    </div>
</div>