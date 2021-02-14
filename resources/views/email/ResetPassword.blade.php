<div style="background: #ecf0f1;text-align: center;padding: 30px;font-family: sans-serif;color: #444;">
    <div style="background-color: #fff;border-radius: 6px;padding: 1px;">
        <div style="margin: 5%;text-align: left;">   
            <h1>Data Science Weekend</h1>
            <p style="text-align: left;margin-top: 35px;line-height: 35px;">
                Hello {{ $user->name }}, Please click on this button in order to resetting your pasword
            </p>
            <br /><br />
            <a href="{{ route('user.resetPassword', $encodedEmail) }}" style="background: #f65271;color: #fff;text-decoration: none;padding: 18px 35px;border-radius: 6px;">
                Reset Password
            </a>
            <br /><br />
            <p style="text-align: left;margin-top: 25px;line-height: 35px;">
                If you feel did not requesting to reset pasword, please login and change your password immediately
            </p>
            <p style="text-align: left;margin-top: 25px;line-height: 35px;">
                Regards,<br />
                Tim Data Science Weekend 2021
            </p>
        </div>
    </div>
</div>