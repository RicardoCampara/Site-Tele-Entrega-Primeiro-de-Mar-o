<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tele-Entrega Primeiro de Março</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Roboto', sans-serif; 
            margin: 0; 
            background-color: #121212; 
            color: #fff; 
            line-height: 1.6; 
        }
        header, footer { 
            background-color: #ff0000; 
            text-align: center; 
            padding: 15px; 
        }
        header h1, footer p { 
            margin: 0; 
        }
        main { 
            padding: 20px; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 20px; 
            background-color: #1e1e1e; 
            border-radius: 8px; 
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        table, th, td { 
            border: none; 
        }
        th, td { 
            padding: 15px; 
            text-align: left; 
        }
        th { 
            background-color: #ff0000; 
            color: #fff; 
            font-weight: 700;
            text-transform: uppercase;
        }
        td { 
            border-bottom: 1px solid #ff0000; 
        }
        input, select, button { 
            margin: 10px 0; 
            padding: 10px; 
            border: 1px solid #ff0000; 
            border-radius: 4px; 
            width: calc(100% - 22px); 
            background-color: #1e1e1e; 
            color: #fff; 
            box-sizing: border-box; 
        }
        input:focus, select:focus, button:focus { 
            outline: none; 
            border-color: #cc0000; 
        }
        button { 
            background-color: #ff0000; 
            color: #fff; 
            cursor: pointer; 
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        button:hover { 
            background-color: #cc0000; 
        }
        button:active {
            transform: scale(0.98);
        }
        .totais, .card { 
            background-color: #1e1e1e; 
            padding: 20px; 
            border-radius: 8px; 
            margin-bottom: 20px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .totais p, .totais ul li { 
            margin: 10px 0; 
        }
        ul { 
            list-style: none; 
            padding: 0; 
        }
        ul li { 
            background: #292929; 
            margin-bottom: 10px; 
            padding: 10px; 
            border-radius: 4px; 
        }
        ul li:last-child { 
            margin-bottom: 0; 
        }
        footer { 
            margin-top: 20px; 
        }
    </style>
</head>
<body>
    <header>
        <h1>Registro de Corridas | Tele-Entrega Primeiro de Março</h1>
    </header>
    <main>
        <form id="formRegistro" class="card">
            <input type="text" id="coleta" placeholder="Coleta" required>
            <input type="text" id="destino" placeholder="Destino" required>
            <select id="motoboy">
                <option value="" selected>Escolha o Motoboy</option>
                <option>Paulinho</option><option>Alexandre</option><option>Anderson</option>
                <option>Rulian</option><option>Alison</option><option>Jonas</option>
            </select>
            <input type="number" id="pagamentoVista" step="0.01" placeholder="Pagamento à Vista">
            <input type="number" id="pagamentoPrazo" step="0.01" placeholder="Pagamento a Prazo">
            <button type="button" onclick="salvarRegistroLocal()">Adicionar</button>
        </form>
        <section>
            <h2>Registros</h2>
            <table id="tabelaRegistros">
                <thead>
                    <tr><th>Data</th><th>Coleta</th><th>Destino</th><th>Motoboy</th><th>À Vista</th><th>A Prazo</th><th>Ações</th></tr>
                </thead>
                <tbody></tbody>
            </table>
        </section>
        <div class="totais">
            <h3>Totais</h3>
            <p id="totalVista">Total à Vista: R$ 0.00</p>
            <p id="totalPrazo">Total a Prazo: R$ 0.00</p>
            <p id="totalDescontos">Total Descontado (25%): R$ 0.00</p>
            <p id="totalDado">Total para o Dado: R$ 0.00</p>
            <ul id="totaisMotoboy"></ul>
        </div>
    </main>
    <footer>
        <p>&copy; 2012 Tele-Entrega Primeiro de Março. Todos os direitos reservados.</p>
    </footer>

    <script>
        let registros = JSON.parse(localStorage.getItem("registros")) || [];

        function atualizarTabela() {
            const tbody = document.querySelector("#tabelaRegistros tbody");
            tbody.innerHTML = "";

            let totalVista = 0, totalPrazo = 0, totalDescontado = 0, totaisPorMotoboy = {
                Paulinho: { vista: 0, prazo: 0 }, Alexandre: { vista: 0, prazo: 0 },
                Anderson: { vista: 0, prazo: 0 }, Rulian: { vista: 0, prazo: 0 },
                Alison: { vista: 0, prazo: 0 }, Jonas: { vista: 0, prazo: 0 }
            };

            registros.forEach((registro, index) => {
                const totalCorrida = (registro.vista || 0) + (registro.prazo || 0);
                const desconto = totalCorrida * 0.25;
                totalDescontado += desconto;

                const row = `<tr>
                    <td>${registro.data}</td>
                    <td>${registro.coleta}</td>
                    <td>${registro.destino}</td>
                    <td>${registro.motoboy}</td>
                    <td>${registro.vista ? `R$ ${registro.vista.toFixed(2)}` : "-"}</td>
                    <td>${registro.prazo ? `R$ ${registro.prazo.toFixed(2)}` : "-"}</td>
                    <td><button onclick="excluirRegistro(${index})">Excluir</button></td>
                </tr>`;
                tbody.innerHTML += row;

                totalVista += registro.vista || 0;
                totalPrazo += registro.prazo || 0;

                if (registro.motoboy) {
                    totaisPorMotoboy[registro.motoboy].vista += registro.vista || 0;
                    totaisPorMotoboy[registro.motoboy].prazo += registro.prazo || 0;
                }
            });

            document.getElementById("totalVista").textContent = `Total à Vista: R$ ${totalVista.toFixed(2)}`;
            document.getElementById("totalPrazo").textContent = `Total a Prazo: R$ ${totalPrazo.toFixed(2)}`;
            document.getElementById("totalDescontos").textContent = `Total Descontado (25%): R$ ${totalDescontado.toFixed(2)}`;
            document.getElementById("totalDado").textContent = `Total para \"Dado\": R$ ${totalDescontado.toFixed(2)}`;

            const ulTotais = document.getElementById("totaisMotoboy");
            ulTotais.innerHTML = "";
            Object.keys(totaisPorMotoboy).forEach(motoboy => {
                const vista = totaisPorMotoboy[motoboy].vista.toFixed(2);
                const prazo = totaisPorMotoboy[motoboy].prazo.toFixed(2);
                const total = (totaisPorMotoboy[motoboy].vista + totaisPorMotoboy[motoboy].prazo).toFixed(2);
                ulTotais.innerHTML += `<li>${motoboy}: À Vista: R$ ${vista} | A Prazo: R$ ${prazo} | Total: R$ ${total}</li>`;
            });
        }

        function salvarRegistroLocal() {
            const coleta = document.getElementById("coleta").value;
            const destino = document.getElementById("destino").value;
            const motoboy = document.getElementById("motoboy").value;
            const vista = parseFloat(document.getElementById("pagamentoVista").value) || 0;
            const prazo = parseFloat(document.getElementById("pagamentoPrazo").value) || 0;

            registros.push({
                data: new Date().toLocaleDateString(), coleta, destino, motoboy, vista, prazo
            });

            localStorage.setItem("registros", JSON.stringify(registros));
            atualizarTabela();
        }

        function excluirRegistro(index) {
            registros.splice(index, 1);
            localStorage.setItem("registros", JSON.stringify(registros));
            atualizarTabela();
        }

        atualizarTabela();
    </script>
</body>
</html>
