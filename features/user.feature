# language: fr
Fonctionnalité: Fonctionnalité Utilisateur
  Scénario: Lister les utilisateurs
    Etant donné que j'ajoute l'entête "Content-Type" égale à "application/json"
    Lorsque j'envoie une requête "GET" sur "/api/users"
    Alors le code de status de la réponse devrait être 200

