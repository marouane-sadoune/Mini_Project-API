# Mini_Project-API


Cette API Produit est construite avec Symfony et permet de gérer des produits dans une base de données. Elle fournit des points de terminaison pour créer, lire, mettre à jour et supprimer des produits.

---

## Fonctionnalités

   - Lister tous les produits.
   - Ajouter de nouveaux produits
   - Mettre à jour des produits existants
   - Supprimer des produits

---

## Installation

Suivez ces étapes pour configurer le projet sur votre machine locale :
1. Clonez le dépôt :
   ```bash
   git clone https://github.com/marouane-sadoune/Mini_Project-API.git
   ```
2. Naviguez dans le répertoire du projet :
   ```bash
   cd Mini_Project-API
   ```
3. Installez les dépendances avec Composer :
   ```bash
   Copy code
   composer install
   ```
4. Configurez la base de donnee :
   ```powershell/cmd
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```
5. Demarer le serveur :
   ```powershell/cmd
   symfony server:start
   ```
6. Accédez à l'API via votre navigateur ou Postman :
   ```bash
   http://127.0.0.1:8000/api
   ```
---

## Points de terminaison de l'API

### Lister tous les produits:
#### GET `/api/products`:
**Réponse :**
   ```json
[
    {
        "id": 1,
        "name": "Produit A",
        "price": 10.0
    },
    {
        "id": 2,
        "name": "Produit B",
        "price": 15.0
    }
]

   ```
### Mettre à jour un produit
#### PUT `/api/products/{id}`

#### Corps de la requête :

```json
{
    "name": "Produit C Modifié",
    "price": 25.0
}
```
**Réponse :**

```json
{
    "id": 3,
    "name": "Produit C Modifié",
    "price": 25.0
}
```
### Supprimer un produit
#### DELETE /api/products/{id}

**Réponse :**

```json
{
    "message": "Produit supprimé avec succès"
}
```
---
### Tester l'API
 - Vous pouvez tester les points de terminaison de l'API avec Postman ou cURL.

### Postman :
   1.Ouvrez Postman.
   2.Importez la collection fournie dans le fichier postman_collection.json.
   3.Exécutez les requêtes et vérifiez les réponses.
### Avec cURL :
   -Exemple de commande pour tester le point de terminaison GET /api/products :

```bash
curl -X GET http://127.0.0.1:8000/api/products
```
**Contribution**
Les contributions sont les bienvenues ! Suivez ces étapes pour contribuer :

   1.Forkez le dépôt.
   2.Créez une nouvelle branche pour votre fonctionnalité :
   ```bash
git checkout -b feature/votre-fonctionnalite
   ```
Validez vos modifications :

   ```bash
git commit -m "Ajoutez votre message ici"
   ```
Poussez votre branche :
```bash
git push origin feature/votre-fonctionnalite
```
Ouvrez une Pull Request sur GitHub.

---

## Licence

Ce projet est sous licence MIT. Consultez le fichier LICENSE pour plus de détails.

---

Dites-moi si vous souhaitez que cette version soit mise à jour dans votre document en cours ! 😊

