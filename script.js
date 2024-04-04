$(document).ready(function() {
    carregarMapa();
});

function carregarTotalizador(codEmpre, torre) {

    $('#loading').show();

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
            elemento.textContent = data[0] && typeof data[0] === 'object' &&
                data[0].hasOwnProperty('disponivel') ? data[0].disponivel : 0;

            var elemento = document.getElementById('qtdIndisponivel');
            elemento.textContent = data[0] && typeof data[0] === 'object' &&
                data[0].hasOwnProperty('indisponivel') ? data[0].indisponivel : 0;

        },
        error: function(error) {
            console.log('Erro ao receber dados: ', error.responseText);
        }
    });
}

function carregarMapa() {

    const urlParams = new URLSearchParams(window.location.search);
    const codEmpre = urlParams.get('codEmpre');
    const torre = urlParams.get('torre');

    carregarTotalizador(codEmpre, torre);

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

                $('#loading').hide();
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