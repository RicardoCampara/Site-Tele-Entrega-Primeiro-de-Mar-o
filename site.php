<?php
$products = [
    ["name" => "Produto 1", "price" => "R$ 49,99", "image" => "https://via.placeholder.com/200x150"],
    ["name" => "Produto 2", "price" => "R$ 89,99", "image" => "https://via.placeholder.com/200x150"],
    ["name" => "Produto 3", "price" => "R$ 29,99", "image" => "https://via.placeholder.com/200x150"],
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Virtual</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        header {
            background-color: #ff5722;
            color: #fff;
            padding: 15px;
            text-align: center;
        }
        nav {
            display: flex;
            justify-content: center;
            background-color: #fff;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #333;
        }
        nav a:hover {
            color: #ff5722;
        }
        .banner {
            width: 100%;
            height: 300px;
            background-image: url('https://via.placeholder.com/1200x300');
            background-size: cover;
            background-position: center;
            margin-bottom: 20px;
        }
        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .product {
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .product img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .product h3 {
            font-size: 18px;
            margin: 10px 0;
        }
        .product p {
            color: #666;
            font-size: 14px;
            margin: 5px 0;
        }
        .product button {
            background-color: #ff5722;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        .product button:hover {
            background-color: #e64a19;
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 15px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Loja Virtual</h1>
    </header>

    <nav>
        <a href="#">Início</a>
        <a href="#">Categorias</a>
        <a href="#">Ofertas</a>
        <a href="#">Contato</a>
    </nav>

    <div class="banner"></div>

    <section class="products">
        <?php foreach ($products as $product): ?>
        <div class="product">
            <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
            <h3><?= $product['name'] ?></h3>
            <p><?= $product['price'] ?></p>
            <button>Comprar</button>
        </div>
        <?php endforeach; ?>
    </section>

    <footer>
        <p>&copy; 2024 Loja Virtual. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
