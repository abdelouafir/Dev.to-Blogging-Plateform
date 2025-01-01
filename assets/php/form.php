<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Article</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-700 text-center">Ajouter un Article</h1>
        
        <form action="./form.php" method="POST">
            <!-- Titre de l'article -->
            <div class="mb-4">
                <label for="title" class="block text-gray-600 mb-2">Titre de l'article</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                    placeholder="Entrez le titre de l'article" 
                    required
                />
            </div>
            
            <!-- Contenu de l'article -->
            <div class="mb-4">
                <label for="content" class="block text-gray-600 mb-2">Contenu</label>
                <textarea 
                    id="content" 
                    name="content" 
                    rows="6" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                    placeholder="Écrivez le contenu ici..." 
                    required
                ></textarea>
            </div>

            <!-- Catégories -->
            <div class="mb-4">
                <label for="category" class="block text-gray-600 mb-2">Catégorie</label>
                <select 
                    id="category" 
                    name="category" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                    required>
                    <option value="">-- Sélectionnez une catégorie --</option>
                    <option value="Tech">Tech</option>
                    <option value="Lifestyle">Lifestyle</option>
                    <option value="Education">Education</option>
                </select>
            </div>

            <!-- Tags -->
            <div class="mb-4">
                <label for="tags" class="block text-gray-600 mb-2">Tags (séparés par des virgules)</label>
                <input 
                    type="text" 
                    id="tags" 
                    name="tags" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                    placeholder="Ex: PHP, MySQL, Tailwind"
                />
            </div>
            
            <!-- Bouton de soumission -->
            <div class="text-center">
                <button 
                    type="submit" 
                    class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-600 transition duration-300">
                    Ajouter l'article
                </button>
            </div>
        </form>
    </div>
</body>
</html>
