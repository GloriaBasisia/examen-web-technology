<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Pharmacie</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 20px;
        }
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40; /* Couleur de fond */
            padding-top: 20px;
        }
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #fff; /* Couleur du texte */
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        .navbar {
            margin-left: 250px; /* Alignement avec la barre latérale */
            background-color: #007bff; /* Couleur de fond de la barre d'entête */
        }
        .navbar-brand {
            color: #fff !important; /* Couleur du texte du titre principal */
            display: flex;
            align-items: center;
        }
        .navbar-brand img {
            height: 40px; /* Taille du logo */
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <!-- Barre de navigation en tête -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">
            <img src="images/pharmacy-logo.png" alt="Logo Pharmacie"> <!-- Chemin vers votre logo -->
            Gestion de Pharmacie
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">À propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Contact</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="profile-pic">
                            <img src="images/user-profile.png" alt="Profil Utilisateur"> <!-- Chemin vers votre image de profil -->
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Profil</a>
                        <a class="dropdown-item" href="#">Déconnexion</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Barre de navigation latérale -->
    <div class="sidebar">
        <h2 class="text-white">Pharmacie</h2>
        <a href="categorie-produit.php"><i class="bi bi-box-seam"></i> Catégorie Produit</a>
        <a href="produit.php"><i class="bi bi-bag"></i> Produits</a>
        <a href="entree-produit.php"><i class="bi bi-box-arrow-in-down"></i> Entrée Produits</a>
        <a href="sortie-produit.php"><i class="bi bi-box-arrow-up"></i> Sortie Produits</a>
        <a href="#"><i class="bi bi-cash"></i> Vente Produits</a>
        <a href="utilisateur.php"><i class="bi bi-person-circle"></i> Utilisateurs</a>
    </div>
     <!-- Modal pour ajouter/modifier un médicament -->
    <?=$contenu?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        let editRow = null;

        document.getElementById('addMedicineForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const name = document.getElementById('medicineName').value;
            const quantity = document.getElementById('quantity').value;
            const price = document.getElementById('price').value;

            if (editRow) {
                editRow.children[0].textContent = name;
                editRow.children[1].textContent = quantity;
                editRow.children[2].textContent = price;
                editRow = null;
                document.getElementById('addMedicineModalLabel').textContent = 'Ajouter Médicament';
                document.querySelector('#addMedicineForm button[type="submit"]').textContent = 'Ajouter';
            } else {
                const tableBody = document.querySelector('table tbody');
                const newRow = document.createElement('tr');

                newRow.innerHTML = `
                    <td>${name}</td>
                    <td>${quantity}</td>
                    <td>${price}</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn">Modifier</button>
                        <button class="btn btn-danger btn-sm delete-btn">Supprimer</button>
                    </td>
                `;

                tableBody.appendChild(newRow);
            }

            $('#addMedicineModal').modal('hide');
            document.getElementById('addMedicineForm').reset();
        });

        document.querySelector('table tbody').addEventListener('click', function(event) {
            if (event.target.classList.contains('edit-btn')) {
                const row = event.target.closest('tr');
                const name = row.children[0].textContent;
                const quantity = row.children[1].textContent;
                const price = row.children[2].textContent;

                document.getElementById('medicineName').value = name;
                document.getElementById('quantity').value = quantity;
                document.getElementById('price').value = price;

                $('#addMedicineModal').modal('show');
                document.getElementById('addMedicineModalLabel').textContent = 'Modifier Médicament';
                document.querySelector('#addMedicineForm button[type="submit"]').textContent = 'Modifier';

                editRow = row;
            }

            if (event.target.classList.contains('delete-btn')) {
                const row = event.target.closest('tr');
                row.remove();
            }
        });
    </script>
</body>
</html>
