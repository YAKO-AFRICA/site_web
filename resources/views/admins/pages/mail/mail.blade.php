<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle demande - YAKO AFRICA</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #076633 0%, #054d26 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }
        
        .header .subtitle {
            font-size: 16px;
            opacity: 0.9;
            font-weight: 300;
        }
        
        .content {
            padding: 30px;
        }
        
        .product-badge {
            display: inline-block;
            background: linear-gradient(135deg, #F9B233 0%, #e6a020 100%);
            color: white;
            padding: 12px 24px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 30px;
            box-shadow: 0 3px 10px rgba(249, 178, 51, 0.3);
        }
        
        .info-section {
            display: flex;
            gap: 30px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        .client-info, .message-info {
            flex: 1;
            min-width: 300px;
            background: #f8f9fa;
            border-radius: 10px;
            padding: 25px;
            border-left: 4px solid #076633;
        }
        
        .client-info h3, .message-info h3 {
            color: #076633;
            font-size: 20px;
            margin-bottom: 20px;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 2px solid #e9ecef;
        }
        
        .client-profile {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .client-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 15px;
            display: block;
            border: 3px solid #076633;
        }
        
        .client-name {
            font-size: 18px;
            font-weight: 600;
            color: #076633;
            margin-bottom: 8px;
        }
        
        .client-contact {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 4px;
        }
        
        .client-details {
            text-align: left;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 600;
            color: #495057;
            flex: 1;
        }
        
        .detail-value {
            flex: 2;
            text-align: right;
            color: #076633;
        }
        
        .message-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            margin-top: 15px;
            line-height: 1.8;
        }
        
        .message-date {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 15px;
        }
        
        .message-date strong {
            color: #076633;
        }
        
        .footer {
            background: #076633;
            color: white;
            padding: 20px 30px;
            text-align: center;
        }
        
        .footer p {
            margin-bottom: 10px;
        }
        
        .footer a {
            color: #F9B233;
            text-decoration: none;
        }
        
        .divider {
            height: 3px;
            background: linear-gradient(90deg, #076633 0%, #F9B233 50%, #076633 100%);
            margin: 30px 0;
        }
        
        @media (max-width: 600px) {
            .info-section {
                flex-direction: column;
                gap: 20px;
            }
            
            .client-info, .message-info {
                min-width: auto;
            }
            
            .detail-row {
                flex-direction: column;
                text-align: left;
            }
            
            .detail-value {
                text-align: left;
                margin-top: 5px;
                font-weight: 500;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>YAKO AFRICA Assurance Vie</h1>
             @if ($data['type'] == 'Pré-souscription')
                <p class="subtitle">Nouvelle demande de devis d'assurance</p>
            @else
                <p class="subtitle">{{ $data['object'] ?? '' }}</p>
            @endif
        </div>
        
        <!-- Content -->
        <div class="content">
            {{-- <!-- Product Badge -->
            <div class="product-badge">
                {{ $data['product'] ?? 'Produit d\'assurance' }}
            </div> --}}
            
            <!-- Main Info Section -->
            <div class="info-section">
                <!-- Client Info -->
                <div class="client-info">
                    <h3>👤 Informations Client</h3>
                    
                    <div class="client-profile">
                        <img class="client-avatar" src="{{ url('assets/img/images/user-default1.jpg') }}" alt="Photo client">
                        <div class="client-name">
                            {{ ($data['customer_lastname'] ?? '') . ' ' . ($data['customer_firstname'] ?? '') }}
                        </div>
                        <div class="client-contact">{{ $data['customer_email'] ?? '' }}</div>
                        <div class="client-contact">📞 {{ $data['customer_phone'] ?? '' }}</div>
                        <div class="client-contact">💬 {{ $data['customer_whatsapp'] ?? $data['customer_phone'] ?? '' }}</div>
                    </div>
                    
                    @if ($data['type'] == 'Pré-souscription')
                        <div class="client-details">
                            <div class="detail-row">
                                <span class="detail-label">Civilité: &nbsp;</span>
                                <span class="detail-value">{{ $data['customer_civility'] ?? '' }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Résidence: &nbsp;</span>
                                <span class="detail-value">{{ $data['customer_residence'] ?? '' }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Fonction: &nbsp;</span>
                                <span class="detail-value">{{ $data['customer_job'] ?? '' }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Date de naissance: &nbsp;</span>
                                <span class="detail-value">{{ \Carbon\Carbon::parse($data['customer_birthday'])->format('d/m/Y') ?? '' }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Personne à assurer: &nbsp;</span>
                                <span class="detail-value">{{ $data['customer_assure'] ?? '' }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Naissance assuré: &nbsp;</span>
                                <span class="detail-value">{{ \Carbon\Carbon::parse($data['assure_birthday'])->format('d/m/Y') ?? '' }}</span>
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Message Info -->
                <div class="message-info">
                    <h3>💬 Message du Client</h3>
                    
                    <div class="message-date">
                        <strong>Envoyé le: &nbsp;</strong> 
                        {{ isset($data['created_at']) ? \Carbon\Carbon::parse($data['created_at'])->format('d/m/Y à H:i') : '' }}
                    </div>
                     @if ($data['type'] == 'Pré-souscription')
                        <div class="message-date">
                            <strong>Produit: &nbsp;</strong> 
                            {{ $data['product'] ?? '' }}
                        </div>
                    @endif
                    
                    <div class="message-content">
                        {!! isset($data['content']) ? nl2br(e($data['content'])) : '' !!}
                    </div>
                </div>
            </div>
            
            <div class="divider"></div>
            
            <!-- Call to Action -->
            <div style="text-align: center; margin-top: 30px;">
                <p style="font-size: 16px; margin-bottom: 20px; color: #6c757d;">
                    Cette demande nécessite votre attention. Veuillez contacter le client dans les plus brefs délais.
                </p>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p><strong>YAKO AFRICA</strong></p>
            <p>Votre partenaire assurance de confiance</p>
            <p>Email: <a href="mailto:info@yakoafricassur.com">info@yakoafricassur.com</a></p>
            <p>Site web: <a href="https://yakoafricassur.com">www.yakoafricassur.com</a></p>
        </div>
    </div>
</body>
</html>