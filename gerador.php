<?php
class GenCard {
    private static string $extra;
    private static int $mm;
    private static int $yy;
    private static string $cvv;

    public static function Gen($extra, $mm = '', $yy = '', $cvv = '', $amo = 10) : array {
        self::$extra = $extra;
        self::$mm = intval($mm);
        self::$yy = intval($yy);
        self::$cvv = preg_replace('/\D/', '', $cvv);

        if (intval($amo) < 1 || intval($amo) > 1000) $amo = 10;

        $cards = [];
        $gcards = [];

        for ($i = 1; $i <= intval($amo); $i++) {
            $card = self::GenCard();
            if (in_array($card[0], $gcards)) continue;
            $gcards[] = $card[0];
            $cards[] = implode('|', $card);
        }

        return $cards;
    }

    private static function GenCard() : array {
        return [self::GenCC(), self::GenMM(), self::GenYY(), self::GenCVV()];
    }

    private static function GenCC() : string {
        $isAmex = (substr(self::$extra, 0, 2) === '37' || substr(self::$extra, 0, 2) === '34');
        $length = $isAmex ? 15 : 16;
        $ccbin = preg_replace('/[^0-9]/', '', substr(self::$extra, 0, $length - 1));
        return self::GenNum($ccbin, $length);
    }

    private static function GenNum($prefix, $length) : string {
        $ccnumber = $prefix;
        while (strlen($ccnumber) < ($length - 1)) {
            $ccnumber .= mt_rand(0, 9);
        }
        $sum = 0;
        $pos = 0;
        $reversedCCnumber = strrev($ccnumber);
        while ($pos < $length - 1) {
            $odd = $reversedCCnumber[$pos] * 2;
            if ($odd > 9) $odd -= 9;
            $sum += $odd;
            if ($pos != ($length - 2)) $sum += $reversedCCnumber[$pos + 1];
            $pos += 2;
        }
        $checkdigit = ((floor($sum / 10) + 1) * 10 - $sum) % 10;
        $ccnumber .= $checkdigit;
        return $ccnumber;
    }

    private static function GenMM() : string {
        return sprintf('%02d', (empty(self::$mm) || self::$mm < 1 || self::$mm > 12 ? mt_rand(1, 12) : self::$mm));
    }

    private static function GenYY() : string {
        $minYear = 2025;
        $maxYear = 2038;
        return (empty(self::$yy) || self::$yy < $minYear || self::$yy > $maxYear ? mt_rand($minYear, $maxYear) : self::$yy);
    }

    private static function GenCVV() : string {
        $isAmex = (substr(self::$extra, 0, 2) === '37' || substr(self::$extra, 0, 2) === '34');
        if ($isAmex) {
            return empty(self::$cvv) || strlen(self::$cvv) != 4 ? sprintf('%04d', mt_rand(1000, 9999)) : self::$cvv;
        }
        return empty(self::$cvv) || strlen(self::$cvv) != 3 ? sprintf('%03d', mt_rand(100, 999)) : self::$cvv;
    }
}

if (isset($_GET['bin']) && isset($_GET['amo'])) {
    $bin = $_GET['bin'];
    $mm = $_GET['mm'] ?? '';
    $yy = $_GET['yy'] ?? '';
    $cvv = $_GET['cvv'] ?? '';
    $amo = $_GET['amo'];
    $cards = GenCard::Gen($bin, $mm, $yy, $cvv, $amo);
    echo implode("\n", $cards);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <title>Gerador de CC</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style type="text/css">
        body {
            background: linear-gradient(135deg, #07080e 0%, #1a1b2e 100%);
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            color: #fff;
            min-height: 100vh;
            padding: 40px;
            margin: 0;
            overflow-x: hidden;
        }
        .card {
            background: #0d0e24;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            max-width: 1200px;
            margin: 0 auto;
        }
        textarea, .form-control {
            background: #07080e;
            color: #fff !important;
            border: 1px solid #2a2b40 !important;
            border-radius: 10px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            padding: 12px;
        }
        textarea {
            min-height: 250px;
            resize: none;
        }
        textarea:focus, .form-control:focus {
            border-color: #4dabf7 !important;
            box-shadow: 0 0 10px rgba(77, 171, 247, 0.3);
            background: #07080e !important;
            color: #fff !important;
            outline: none !important;
        }
        .btn {
            border-radius: 10px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: scale(1.08);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .result-box {
            background: #07080e;
            border: 1px solid #2a2b40;
            border-radius: 10px;
            padding: 20px;
        }
        .result-item {
            font-family: monospace;
            font-size: 12px;
            padding: 5px 0;
        }
        .row {
            margin-bottom: 30px;
        }
        .col-md-3, .col-md-2, .col-md-1 {
            margin-bottom: 20px;
        }
        .menu-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            font-size: 24px;
            color: #fff;
            cursor: pointer;
            z-index: 1000;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100%;
            background: #0d0e24;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.5);
            transition: left 0.3s ease;
            z-index: 999;
            padding: 60px 20px 20px;
        }
        .sidebar.active {
            left: 0;
        }
        .sidebar-item {
            display: flex;
            align-items: center;
            padding: 15px;
            color: #fff;
            text-decoration: none;
            transition: background 0.3s ease;
            cursor: pointer;
        }
        .sidebar-item:hover {
            background: #1a1b2e;
        }
        .sidebar-item i {
            margin-right: 10px;
        }
        @media (max-width: 768px) {
            .card {
                padding: 20px;
            }
            .row {
                margin-bottom: 20px;
            }
            .col-md-3, .col-md-2, .col-md-1 {
                flex: 0 0 100%;
                max-width: 100%;
            }
            .sidebar {
                width: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="menu-btn" id="menu-btn"><i class="fas fa-bars"></i></div>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-item" id="index-btn"><i class="fas fa-arrow-left"></i> Voltar à Index</div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" id="bin" class="form-control" placeholder="BIN/Matriz (ex: 510510)">
                </div>
                <div class="col-md-2">
                    <select id="mm" class="form-control">
                        <option value="">Mês Aleatório</option>
                        <?php for ($i = 1; $i <= 12; $i++) echo "<option value='$i'>" . sprintf('%02d', $i) . "</option>"; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select id="yy" class="form-control">
                        <option value="">Ano Aleatório</option>
                        <?php for ($i = 2025; $i <= 2038; $i++) echo "<option value='$i'>$i</option>"; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="text" id="cvv" class="form-control" placeholder="CVV (3 ou 4, ou vazio)">
                </div>
                <div class="col-md-2">
                    <input type="number" id="amo" class="form-control" placeholder="Quantidade (max 1000)" min="1" max="1000">
                </div>
                <div class="col-md-1">
                    <button class="btn btn-success w-100" id="generate"><i class="fas fa-play"></i></button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <textarea id="generated-cards" class="form-control" placeholder="Cartões gerados aparecerão aqui..."></textarea>
                </div>
                <div class="col-md-4">
                    <div class="result-box">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <small class="font-weight-bold text-success">Gerados</small>
                            <div>
                                <button class="btn btn-sm btn-success mr-2" id="copy-generated" title="Copiar">
                                    <i class="fas fa-copy"></i>
                                </button>
                                <button class="btn btn-sm btn-primary" id="use-generated" title="Usar na Index">
                                    <i class="fas fa-arrow-left"></i>
                                </button>
                            </div>
                        </div>
                        <div id="generated-list" class="result-item" style="height: 200px; overflow-y: auto;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            toastr.options = {
                positionClass: "toast-bottom-right",
                progressBar: true,
                timeOut: 3000,
                preventDuplicates: true
            };

            $('#generate').click(function() {
                const bin = $('#bin').val().trim();
                const mm = $('#mm').val();
                const yy = $('#yy').val();
                const cvv = $('#cvv').val().trim();
                const amo = $('#amo').val() || 10;

                if (!bin || bin.length < 6) {
                    toastr.error("Insira uma BIN/Matriz válida (mínimo 6 dígitos)!");
                    return;
                }

                $.ajax({
                    url: 'gerador.php',
                    type: 'GET',
                    data: { bin, mm, yy, cvv, amo },
                    success: function(response) {
                        const cards = response.trim().split('\n');
                        $('#generated-cards').val(response);
                        $('#generated-list').empty();
                        cards.forEach(card => {
                            $('#generated-list').append(`<div class="result-item text-success">${card}</div>`);
                        });
                        toastr.success(`Gerados ${cards.length} cartões!`);
                    },
                    error: function() {
                        toastr.error("Erro ao gerar cartões!");
                    }
                });
            });

            $('#copy-generated').click(function() {
                const text = $('#generated-cards').val();
                navigator.clipboard.writeText(text);
                toastr.success("Cartões copiados!");
            });

            $('#use-generated').click(function() {
                const text = $('#generated-cards').val();
                if (window.opener && !window.opener.closed) {
                    window.opener.$('#lista_cartoes').val(text);
                    toastr.success("Cartões enviados para a Index!");
                } else {
                    toastr.error("Index não encontrada! Abra o gerador a partir da Index.");
                }
            });

            $('#menu-btn').click(function() {
                $('#sidebar').toggleClass('active');
            });

            $('#index-btn').click(function() {
                if (window.opener && !window.opener.closed) {
                    window.opener.focus();
                    window.close();
                } else {
                    window.location.href = 'index.php';
                }
            });
        });
    </script>
</body>
</html>