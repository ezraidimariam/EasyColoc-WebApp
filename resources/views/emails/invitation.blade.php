<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation EasyColoc</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #36e270, #2bc05a);
            border-radius: 16px;
            margin-bottom: 20px;
            font-size: 24px;
            color: white;
            font-weight: bold;
        }
        h1 {
            color: #1a1a1a;
            font-size: 28px;
            margin: 0;
        }
        .invitation-card {
            background: linear-gradient(135deg, #36e27010, #36e27005);
            border: 2px solid #36e270;
            border-radius: 12px;
            padding: 30px;
            margin: 30px 0;
            text-align: center;
        }
        .colocation-name {
            font-size: 24px;
            font-weight: bold;
            color: #1a1a1a;
            margin: 15px 0;
        }
        .inviter-info {
            color: #666;
            margin: 10px 0;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #36e270, #2bc05a);
            color: white;
            text-decoration: none;
            padding: 16px 32px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            margin: 20px 0;
            transition: transform 0.2s;
        }
        .cta-button:hover {
            transform: translateY(-2px);
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 14px;
        }
        .note {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            font-size: 14px;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">EC</div>
            <h1>Invitation à rejoindre une colocation</h1>
        </div>

        <div class="invitation-card">
            <div class="colocation-name">{{ $colocation->name }}</div>
            <div class="inviter-info">
                Vous avez été invité par <strong>{{ $inviter->name }}</strong> ({{ $inviter->email }})
            </div>
            <div class="inviter-info">
                Cette invitation est pour l'adresse email : <strong>{{ $invitation->email }}</strong>
            </div>
        </div>

        <div style="text-align: center;">
            <a href="{{ $invitationUrl }}" class="cta-button">
                Accepter l'invitation
            </a>
        </div>

        <div class="note">
            <strong>Note importante :</strong> Cette invitation est personnelle et ne peut être utilisée 
            que par l'adresse email {{ $invitation->email }}. Si vous avez déjà une colocation active, 
            vous ne pourrez pas en rejoindre une nouvelle.
        </div>

        <div class="footer">
            <p>Cet email a été envoyé via EasyColoc</p>
            <p>Si vous n'avez pas demandé cette invitation, vous pouvez ignorer cet email.</p>
        </div>
    </div>
</body>
</html>
