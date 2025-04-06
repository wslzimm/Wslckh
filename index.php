<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <title>CHK MULTI by: @NocyamIsLonely</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
            padding: 20px;
            margin: 0;
            overflow-x: hidden;
        }
        .card {
            background: #0d0e24;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.5);
        }
        textarea, .form-control {
            background: #07080e;
            color: #fff !important;
            border: 1px solid #2a2b40 !important;
            border-radius: 10px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
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
        .result-box {
            background: #07080e;
            border: 1px solid #2a2b40;
            border-radius: 10px;
            padding: 15px;
            transition: border-color 0.3s ease;
        }
        .result-box:hover {
            border-color: #4dabf7;
        }
        .result-item {
            font-family: monospace;
            font-size: 12px;
            padding: 5px 0;
        }
        .status-badge {
            font-size: 12px;
            padding: 8px 12px;
            border-radius: 15px;
            transition: transform 0.2s ease;
        }
        .status-badge:hover {
            transform: scale(1.1);
        }
        .btn {
            border-radius: 10px;
            padding: 8px 15px;
            transition: all 0.3s ease;
            outline: none !important;
        }
        .btn:hover {
            transform: scale(1.08);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .btn:focus {
            box-shadow: none !important;
        }
        .btn-group > .btn {
            min-width: 50px;
        }
        .box-header {
            font-weight: 600;
            font-size: 16px;
            letter-spacing: 0.5px;
        }
        .progress {
            height: 25px;
            border-radius: 10px;
            background: #2a2b40;
            overflow: hidden;
        }
        .progress-bar {
            transition: width 0.5s ease-in-out;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
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
            .control-row .col-md-2,
            .control-row .col-md-4,
            .control-row .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
                margin-bottom: 20px;
            }
            .btn-group {
                display: flex;
                justify-content: space-between;
                width: 100%;
            }
            .result-box {
                height: auto;
                min-height: 150px;
            }
            .card {
                padding: 20px;
            }
            .sidebar {
                width: 200px;
            }
        }
    </style>
</head>
<body>
    <input type="hidden" value="<?php echo $base64Value; ?>" id="token_api">

    <div class="menu-btn" id="menu-btn"><i class="fas fa-bars"></i></div>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-item" id="gerador-btn"><i class="fas fa-credit-card"></i> Gerador</div>
    </div>
    </div>

    <div class="container-fluid">
        <div class="card mb-3">
            <div class="row control-row mb-4 align-items-center">
                <div class="col-md-2">
                    <select id="threads" class="form-control">
                        <option value="2">2 Threads</option>
                        <option value="4">4 Threads</option>
                        <option value="8">8 Threads</option>
                    </select>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 mb-2 mb-md-0">
                            <select id="api1" class="form-control">
                                <option value="">selecione o chk</option>
                                <option value="">CC</option>
                                <option value="api1.php">GG</option>
                              
                        </div>
                        <div class="col-md-6">
                            <select id="api2" class="form-control">
                               
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row control-row mb-3 justify-content-end">
                <div class="col-md-6 text-right">
                    <div class="btn-group">
                        <button class="btn btn-success" id="chk-start" title="Iniciar"><i class="fas fa-play"></i></button>
                        <button class="btn btn-warning" id="chk-pause" disabled title="Pausar"><i class="fas fa-pause"></i></button>
                        <button class="btn btn-danger" id="chk-stop" disabled title="Parar"><i class="fas fa-stop"></i></button>
                        <button class="btn btn-info" id="chk-clean" title="Limpar"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div class="progress">
                        <div id="progress-bar" class="progress-bar bg-success" style="width: 0%;">
                            0%
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div class="d-flex justify-content-around flex-wrap">
                        <span class="status-badge badge badge-primary">Total: <span id="total-count">0</span></span>
                        <span class="status-badge badge badge-success">Live: <span id="live-count">0</span></span>
                        <span class="status-badge badge badge-danger">Die: <span id="die-count">0</span></span>
                        <span class="status-badge badge badge-warning">Erros: <span id="error-count">0</span></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mb-3">
                    <textarea id="lista_cartoes" class="form-control" placeholder="Cole sua lista aqui..."></textarea>
                </div>
                <div class="col-md-4">
                    <div class="result-box mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <small class="box-header text-success">Aprovadas</small>
                            <div>
                                <button class="btn btn-sm btn-success mr-2" id="copy-lives" title="Copiar aprovadas">
                                    <i class="fas fa-copy"></i>
                                </button>
                                <button class="btn btn-sm btn-primary" id="export-lives" title="Exportar aprovadas">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </div>
                        <div id="lives" class="result-item" style="height: 150px; overflow-y: auto;"></div>
                    </div>
                    <div class="result-box mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <small class="box-header text-danger">Reprovadas</small>
                            <button class="btn btn-sm btn-danger" id="clear-dies" title="Limpar reprovadas">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div id="dies" class="result-item" style="height: 150px; overflow-y: auto;"></div>
                    </div>
                    <div class="result-box">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <small class="box-header text-warning">Erros</small>
                            <button class="btn btn-sm btn-warning" id="clear-errors" title="Limpar erros">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div id="errors" class="result-item" style="height: 150px; overflow-y: auto;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript">
        const startAudio = new Audio('ext.mp3');
        const liveAudio = new Audio('cu.mp3');

        $(document).ready(function() {
            let worker = {
                active: false,
                paused: false,
                threads: 2,
                total: 0,
                tested: 0,
                lives: 0,
                dies: 0,
                errors: 0,
                requests: [],
                currentIndex: 0,
                originalList: [],
                apis: [],
                processingCount: 0,
                apiProcessing: {}
            };

            toastr.options = {
                positionClass: "toast-bottom-right",
                progressBar: true,
                timeOut: 3000,
                preventDuplicates: true
            };

            function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }

            function validateCard(line) {
                const regex = /^\d{15,16}\|\d{1,2}\|\d{2,4}\|\d{3,4}$/;
                return regex.test(line.replace(/\s/g, ''));
            }

            function animateCounter(element, target) {
                $({ count: parseInt(element.text()) }).animate({ count: target }, {
                    duration: 500,
                    easing: 'swing',
                    step: function() {
                        element.text(Math.round(this.count));
                    }
                });
            }

            function updateProgress() {
                const progress = worker.total ? (worker.tested / worker.total) * 100 : 0;
                $('#progress-bar').css('width', progress + '%').text(Math.round(progress) + '%');
                animateCounter($('#live-count'), worker.lives);
                animateCounter($('#die-count'), worker.dies);
                animateCounter($('#error-count'), worker.errors);
                animateCounter($('#total-count'), worker.total);

                if (worker.active) {
                    const remaining = worker.originalList.slice(worker.currentIndex).join('\n');
                    $('#lista_cartoes').val(remaining);
                }
            }

            function processLine(index, api) {
                if (!worker.active || worker.paused || index >= worker.originalList.length) return;

                const line = worker.originalList[index];
                worker.processingCount++;
                worker.apiProcessing[api] = (worker.apiProcessing[api] || 0) + 1;

                const ajaxReq = $.ajax({
                    url: api,
                    type: 'GET',
                    data: {
                        lista: line,
                        token_api: $('#token_api').val(),
                        telegram_id: $('#telegram_id').val()
                    },
                    beforeSend: function() {
                        $('#progress-bar').removeClass('bg-success').addClass('bg-info');
                    },
                    success: function(response) {
                        const resp = response.trim();
                        if (resp.indexOf("Aprovada") >= 0) {
                            worker.lives++;
                            $('#lives').prepend(`<div class="result-item text-success">[${api}] ${resp}</div>`);
                            toastr.success(`[${api}] Aprovada! ${line}`);
                            liveAudio.pause();
                            liveAudio.currentTime = 0;
                            liveAudio.play();
                        } else if (resp.indexOf("Reprovada") >= 0) {
                            worker.dies++;
                            $('#dies').prepend(`<div class="result-item text-danger">[${api}] ${resp}</div>`);
                            toastr.error(`[${api}] Reprovada! ${line}`);
                        } else {
                            worker.errors++;
                            $('#errors').prepend(`<div class="result-item text-warning">[${api}] ${resp}</div>`);
                            toastr.warning(`[${api}] Erro! ${line}`);
                        }
                    },
                    error: function(xhr, status, error) {
                        worker.errors++;
                        $('#errors').prepend(`<div class="result-item text-warning">[${api}] Erro de conexão: ${line}</div>`);
                        toastr.warning(`[${api}] Erro de conexão! ${line}`);
                    },
                    complete: function() {
                        worker.tested++;
                        worker.processingCount--;
                        worker.apiProcessing[api]--;
                        $('#progress-bar').removeClass('bg-info').addClass('bg-success');
                        updateProgress();

                        if (!worker.paused && worker.active) {
                            processNext();
                        }
                    }
                });
                worker.requests.push(ajaxReq);
            }

            function processNext() {
                if (!worker.active || worker.paused || worker.currentIndex >= worker.originalList.length) return;

                while (worker.processingCount < worker.threads && worker.currentIndex < worker.originalList.length) {
                    let selectedApi = worker.apis[0];
                    let minProcessing = worker.apiProcessing[selectedApi] || 0;

                    for (let i = 1; i < worker.apis.length; i++) {
                        const api = worker.apis[i];
                        const count = worker.apiProcessing[api] || 0;
                        if (count < minProcessing) {
                            selectedApi = api;
                            minProcessing = count;
                        }
                    }

                    processLine(worker.currentIndex, selectedApi);
                    worker.currentIndex++;
                }
            }

            $('#chk-start').click(debounce(function() {
                const lista = $('#lista_cartoes').val().trim().split('\n').filter(l => l.trim());
                const invalidLines = lista.filter(line => !validateCard(line));
                const api1 = $('#api1').val();
                const api2 = $('#api2').val();

                if (lista.length === 0) {
                    toastr.error("Insira uma lista válida!");
                    return;
                }
                if (invalidLines.length > 0) {
                    toastr.error(`Linhas inválidas detectadas: ${invalidLines.length}`);
                    return;
                }
                if (!api1) {
                    toastr.error("Selecione pelo menos uma API!");
                    return;
                }

                worker = {
                    active: true,
                    paused: false,
                    threads: parseInt($('#threads').val()),
                    total: lista.length,
                    tested: 0,
                    lives: 0,
                    dies: 0,
                    errors: 0,
                    requests: [],
                    currentIndex: 0,
                    originalList: lista,
                    apis: [api1],
                    processingCount: 0,
                    apiProcessing: {}
                };

                if (api2 && api2 !== api1) {
                    worker.apis.push(api2);
                }

                $('#chk-stop, #chk-pause').prop('disabled', false);
                $('#chk-start').prop('disabled', true);
                $('#lista_cartoes, #api1, #api2').prop('readonly', true);

                toastr.info(`Checker iniciado com ${worker.apis.length} API(s) e ${worker.threads} thread(s)!`);
                startAudio.play();

                processNext();
                $(this).blur();
            }, 300));

            $('#chk-pause').click(debounce(function() {
                worker.paused = !worker.paused;
                $(this).html(worker.paused ? '<i class="fas fa-play"></i>' : '<i class="fas fa-pause"></i>');
                toastr.info(worker.paused ? "Checker pausado!" : "Checker retomado!");
                if (!worker.paused) {
                    processNext();
                }
                $(this).blur();
            }, 300));

            $('#chk-stop').click(debounce(function() {
                worker.active = false;
                worker.requests.forEach(req => req.abort());
                $('#chk-stop, #chk-pause').prop('disabled', true);
                $('#chk-start').prop('disabled', false);
                $('#lista_cartoes, #api1, #api2').prop('readonly', false);
                toastr.warning("Checker interrompido!");
                startAudio.pause();
                liveAudio.pause();
                $(this).blur();
            }, 300));

            $('#chk-clean').click(debounce(function() {
                $('#lista_cartoes').val('').prop('readonly', false);
                $('#lives, #dies, #errors').empty();
                $('#api1, #api2').prop('readonly', false);
                worker = {
                    active: false,
                    paused: false,
                    threads: 2,
                    total: 0,
                    tested: 0,
                    lives: 0,
                    dies: 0,
                    errors: 0,
                    requests: [],
                    currentIndex: 0,
                    originalList: [],
                    apis: [],
                    processingCount: 0,
                    apiProcessing: {}
                };
                updateProgress();
                toastr.info("Dados resetados!");
                startAudio.pause();
                liveAudio.pause();
                $(this).blur();
            }, 300));

            $('#copy-lives').click(function() {
                const livesText = $('#lives').text();
                navigator.clipboard.writeText(livesText);
                toastr.success("Aprovadas copiadas!");
                $(this).blur();
            });

            $('#export-lives').click(function() {
                const livesText = $('#lives').children().map((i, el) => $(el).text()).get().join('\n');
                const blob = new Blob([livesText], { type: 'text/csv' });
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'aprovadas.csv';
                a.click();
                window.URL.revokeObjectURL(url);
                toastr.success("Aprovadas exportadas como CSV!");
                $(this).blur();
            });

            $('#clear-dies').click(function() {
                $('#dies').empty();
                toastr.info("Reprovadas limpas!");
                $(this).blur();
            });

            $('#clear-errors').click(function() {
                $('#errors').empty();
                toastr.info("Erros limpos!");
                $(this).blur();
            });

            $('#menu-btn').click(function() {
                $('#sidebar').toggleClass('active');
            });

            $('#gerador-btn').click(function() {
                const geradorWindow = window.open('gerador.php', '_blank', 'width=800,height=600');
                geradorWindow.focus();
            });
        });
    </script>
</body>
</html>