module.exports = {
  extends: ['@commitlint/config-conventional'],
  rules: {
    'type-enum': [
      2,
      'always',
      [
        'feat',
        'fix',
        'docs',
        'style',
        'refactor',
        'perf',
        'test',
        'chore'
      ]
    ],
    'subject-case': [0]
  },
  helpUrl:
    '\n\n❌ Commit inválido!\n\n' +
    'Exemplos válidos de Conventional Commits:\n' +
    '  feat: adiciona autenticação JWT\n' +
    '  fix: corrige erro no login\n' +
    '  docs: atualiza README\n' +
    '  style: ajusta indentação no controller\n' +
    '  refactor: melhora lógica de autenticação\n' +
    '  perf: otimiza query de listagem\n' +
    '  test: adiciona testes de unidade em UserService\n' +
    '  chore: atualiza dependências do composer\n',
};