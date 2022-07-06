# dasdas

Listar qual usuário vai ter um livro cadastrado
Opções:

- Ver livros emprestados
- Emprestar Livro
- Devolver Livro

Ver livros emprestados:

- Buscar na user_books os livros do usuário selecionado
    - WHERE user_id = id
- Listar no CLI livros que o usuário não tenha emprestado ainda
    - SELECT * FROM books WHERE id NOT IN (ids)
- Cadastrar livro selecionado no user_books


Fluxo de cadastro: 

- Buscar livros que o usuário não tenha emprestado ainda
    - WHERE user_id != id
- Salvar em user_books com o ID do livro selecionado

Fluxo de devolução:

- Buscar livros que o usuário emprestou e não devolveu
    - WHERE devolution_at = NULL
- Atualizar registro do user_books colocando a data/hora da devolução





Deixar ele cadastrar um desses livros.