$(document).ready(function() {

    carregarSelectTorre();
    carregarSelectEmpreendimentos();

    $('#loading').hide();
});


function carregarSelectEmpreendimentos() {

    $.ajax({
        url: './controller/mapaController.php',
        type: 'GET',
        data: {
            action: 'retornarEmpreendimentos'
        },
        dataType: 'json',
        success: function(data) {
            var select = $('#selectEmpreendimento');
            select.empty();

            var defaultOption = $("<option>").attr("value", "0").text("ESCOLHA O EMPREENDIMENTO");
            select.append(defaultOption);

            $.each(data, function(index, item) {
                var newOption = $("<option>").attr("value", item.codEmpree).text(item.nome);
                select.append(newOption);
            });

            // Ao escolher uma opção
            select.on('change', function() {
                var codEmpre = $(this).val();
                carregarSelectTorre(codEmpre);

                var tabela = $('#tabela-disponibilidade');
                tabela.empty();
            });
        },
        error: function(error) {
            console.log('Erro ao carregar as opções: ', error.responseText);
        }
    });
}

function carregarSelectTorre(codEmpre) {

    $("#loading").show();

    $.ajax({
        url: './controller/mapaController.php',
        type: 'GET',
        data: {
            action: 'retornarTorres',
            codEmpree: codEmpre
        },
        dataType: 'json',
        success: function(data) {
            var select = $('#selectTorre');
            select.empty();

            var defaultOption = $("<option>").attr("value", "0").text("ESCOLHA A TORRE");
            select.append(defaultOption);

            $.each(data, function(index, item) {
                var newOption = $("<option>").attr("value", item.numUnid).text(item.numUnid2);
                select.append(newOption);
            });

            // Ao escolher uma opção
            select.on('change', function() {
                var torre = $(this).val();

                var tabela = $('#tabela-disponibilidade');
                tabela.empty();
            });

            $("#loading").hide();

        },
        error: function(error) {
            console.log('Erro ao carregar as opções: ', error.responseText);

        }
    });
}

function carregarTotalizador() {

    codEmpre = document.getElementById("selectEmpreendimento").value;
    torre = document.getElementById("selectTorre").value;

    $.ajax({
        url: "./controller/mapaController.php",
        type: 'GET',
        data: {
            action: 'retornarTotalizador',
            codEmpre: codEmpre,
            torre: torre
        },
        dataType: 'json',
        success: function(data) {

            var elemento = document.getElementById('qtdDisponivel');
            elemento.textContent = data[0] && typeof data[0] === 'object' && data[0].hasOwnProperty('disponível') ? data[0].disponível : 0;

            var elemento = document.getElementById('qtdReservado');
            elemento.textContent = data[0] && typeof data[0] === 'object' && data[0].hasOwnProperty('reservado') ? data[0].reservado : 0;

            var elemento = document.getElementById('qtdVendido');
            elemento.textContent = data[0] && typeof data[0] === 'object' && data[0].hasOwnProperty('vendido') ? data[0].vendido : 0;

            var elemento = document.getElementById('qtdAlugado');
            elemento.textContent = data[0] && typeof data[0] === 'object' && data[0].hasOwnProperty('alugado') ? data[0].alugado : 0;

            var elemento = document.getElementById('qtdComercial');
            elemento.textContent = data[0] && typeof data[0] === 'object' && data[0].hasOwnProperty('comercial') ? data[0].comercial : 0;

            var elemento = document.getElementById('qtdPermuta');
            elemento.textContent = data[0] && typeof data[0] === 'object' && data[0].hasOwnProperty('permuta') ? data[0].permuta : 0;
        },
        error: function(error) {
            console.log('Erro ao receber dados: ', error.responseText);
        }
    });
}

function carregarMapa(codEmpre, torre) {

    $("#loading").show();

    codEmpre = document.getElementById("selectEmpreendimento").value;
    torre = document.getElementById("selectTorre").value;

    carregarTotalizador();

    if (codEmpre != 0) {

        $.ajax({
            url: "./controller/mapaController.php",
            type: 'GET',
            data: {
                action: 'retornarMapa',
                codEmpre: codEmpre,
                torre: torre
            },
            dataType: 'json',
            success: function(data) {
                var tabela = $('#tabela-disponibilidade');
                tabela.empty();
                var andares = {};

                // Agrupar unidades por andar
                data.forEach(function(item) {
                    var andar = item.andarUnidade.split('-')[0];
                    if (!andares[andar]) {
                        andares[andar] = [];
                    }
                    andares[andar].push(item.andarUnidade);
                });

                // Adicionar dados à tabela
                var tabelaHtml = $('<table>', {
                    id: 'tabela-disponibilidade',
                    css: {
                        'border-collapse': 'separate',
                        'border-spacing': '2px',
                        'margin': '0 auto'
                    }
                });

                // Inverter a ordem das chaves do objeto 'andares'
                var andaresKeys = Object.keys(andares).reverse();
                for (var i = 0; i < andaresKeys.length; i++) {
                    var andar = andaresKeys[i];
                    var linha = $('<tr>');
                    linha.append($('<td>').text(andar));
                    andares[andar].forEach(function(unidade) {

                        var unidadeSplit = unidade.split('-');
                        console.log(unidadeSplit[2]);
                        var td = $('<td>', {
                            text: unidadeSplit[1],
                            class: unidadeSplit[2].toLowerCase(),
                            css: {
                                'border-radius': '0px',
                                'text-align': 'center',
                                'color': 'white'
                            },
                            'data-tooltip': `<b>${unidadeSplit[1] || '--'}</b><br/>
                                            ID: ${unidadeSplit[3] || '--'}<br/>
                                            DTA: ${unidadeSplit[4] || '--'}<br/>
                                            STS: ${unidadeSplit[5] || '--'}<br/>
                                            CLI: ${unidadeSplit[6] || '--'}`,
                            'data-html': 'true', // Permitir conteúdo HTML no tooltip
                        });

                        // Adicionando tooltip do Materialize CSS
                        td.addClass('tooltipped');
                        linha.append(td);
                    });
                    tabelaHtml.append(linha);
                }

                $('#tabela-disponibilidade').empty().append(tabelaHtml);

                // Inicializar tooltips do Materialize CSS
                $('.tooltipped').tooltip();
                $("#loading").hide();
            },
            error: function(error) {
                console.log('Erro ao receber dados: ', error.responseText);
                $('#loading').hide();
            }
        });
    } else {
        Materialize.toast('Escolha um empreendimento!', 2000, 'red white-text top right');
    }
}