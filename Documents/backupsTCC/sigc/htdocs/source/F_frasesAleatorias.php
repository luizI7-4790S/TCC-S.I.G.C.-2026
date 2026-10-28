<?php
    
function escolherFrase(){
	
    
$frases = [
    // Dicas e funcionalidades do SIGC
    "Dica do SIGC: se o nome de um responsável aparecer em laranja na lista de alunos, calma! Isso indica que o responsável está arquivado. O sistema está te dando uma pista, não um motivo para pânico. 🟠",

    "Sabia que as mensalidades podem ser filtradas por data, situação e método de pagamento? O SIGC gosta de organização. Diferente daquela gaveta onde você guarda todos os cabos. 🔌",

    "Antes de considerar um cadastro perdido para sempre, lembre-se da Lixeira! No SIGC, arquivar não é necessariamente dizer adeus. É mais um 'vamos conversar depois'. 🗑️",

    "Dica: o segundo sábado do mês é importante para as mensalidades! Depois dele, o sistema considera os pagamentos como atrasados e sugere o acréscimo previsto. O calendário também faz parte da equipe. 📅",

    "O SIGC tem uma lista de inadimplentes. Ela não julga ninguém, só faz perguntas financeiras que ninguém gostaria de receber numa reunião de família. 💸",

    "Precisa encontrar um pagamento específico? Experimente os filtros da pesquisa de mensalidades. Às vezes, a informação não sumiu: ela só está escondida atrás de um filtro. 🔎",

    "Os relatórios em PDF estão aí para facilitar sua vida. Porque copiar uma tabela inteira para outro documento manualmente é uma ótima maneira de descobrir novos motivos para procrastinar. 📄",

    "Dica do dia: confira o nome do aluno antes de registrar uma mensalidade. O dinheiro pode até ser o mesmo, mas o cadastro errado vai transformar uma tarefa simples numa investigação criminal... administrativa. 🕵️",

    "Se o responsável estiver arquivado, o nome dele pode aparecer em laranja no relatório de alunos. O SIGC não está decorando a tabela: está tentando te contar alguma coisa. 🎨",

    "O sistema permite registrar pagamentos por Pix ou dinheiro. Infelizmente, ainda não aceita pagamento em elogios ao desenvolvedor. Estou trabalhando nisso. 😎",

    "Você sabia que é possível consultar os pagamentos de um mês específico? O SIGC tem memória para os registros que estão no banco. Já eu recomendo não confiar tanto na memória humana. 🧠",

    "Dica: use o campo de observação da mensalidade quando precisar registrar algum detalhe importante. O seu eu do futuro vai agradecer por não ter que resolver um mistério sem pistas. 📝",

    "O botão de arquivar não é um portal para outra dimensão. Os registros vão para a Lixeira, onde podem ser recuperados. Pelo menos é mais organizado que empilhar papéis numa gaveta. 🗑️",

    "O SIGC organiza os alunos por pelotão nos relatórios. Porque até uma lista de nomes precisa saber marchar em formação. 🫡",

    "Se o valor padrão da mensalidade estiver configurado, o sistema pode preencher o campo automaticamente. Menos digitação, menos trabalho e menos oportunidades para o dedo apertar a tecla errada. ⌨️",

    "O sistema separa os pagamentos registrados dos alunos que ainda não pagaram. É quase como uma chamada escolar, só que a resposta 'presente' vem acompanhada de comprovante. 💰",

    // Humor sobre o COTER e a rotina
    "No COTER, disciplina é importante. No banco de dados, também. Uma mensalidade fora do lugar e começa a operação de busca e salvamento. 🫡",

    "O SIGC trabalha com alunos, responsáveis, pelotões e mensalidades. Só não trabalha com telepatia. Se algum dado estiver errado, confira o cadastro antes de culpar a máquina. 🤖",

    "Relatório organizado, cadastro atualizado e mensalidades conferidas. O trio perfeito. O quarto elemento seria alguém trazer café para o desenvolvedor. ☕",

    "A missão de hoje: manter os cadastros em ordem. A missão secundária: não clicar em cinco botões diferentes para resolver algo que precisava de apenas um. 🎯",

    "O SIGC não tem patente militar, mas já enfrentou muitas operações de manutenção. Algumas terminaram em sucesso; outras exigiram reiniciar o servidor e fingir naturalidade. 🫡",

    "Se o sistema fosse um pelotão, o banco de dados seria o responsável por guardar os suprimentos. Sem ele, ninguém sabe onde foi parar absolutamente nada. 🗃️",

    "No COTER, cada aluno tem seu pelotão. No SIGC, cada informação tem seu lugar. E quando não tem, nasce uma nova tarefa para o desenvolvedor. 😂",

    "Atenção, equipe! O relatório está pronto, os dados estão organizados e o botão está funcionando. Repito: o botão está funcionando. Aproveitem enquanto dura. 📢",

    "O SIGC foi criado para facilitar a gestão. Se você está fazendo manualmente algo que o sistema já oferece, talvez exista um botão esperando para ser descoberto. 👀",

    // Humor de programador
    "O desenvolvedor passou horas criando esta funcionalidade. Você levou três segundos para encontrar um jeito de usá-la de uma forma que ele nunca imaginou. Isso é trabalho em equipe. 🤝",

    "Se alguma coisa parecer estranha, confira os filtros, os dados e a data selecionada antes de declarar emergência. Às vezes, o problema é só outubro sendo outubro. 📅",

    "O sistema não é perfeito. Mas cada atualização é uma tentativa honesta de fazer com que ele precise de menos atualizações. A lógica é questionável, mas a intenção é boa. 🔧",

    "Todo sistema começa com uma ideia simples. Depois aparecem os relatórios, os filtros, as exceções, os casos especiais e aquela função que ninguém lembra por que existe. 🫠",

    "O banco de dados guarda muita informação. A lista de tarefas do desenvolvedor guarda informações ainda mais preocupantes. 📋",

    "Um pequeno lembrete: se algo funcionou depois de uma alteração no código, teste novamente antes de comemorar. O computador também gosta de fazer pegadinhas. 🐛",

    "O programador disse: 'vou fazer só uma alteraçãozinha'. Três horas depois, está pesquisando por que uma div decidiu abandonar a família. 💻",

    "O SIGC está sempre evoluindo. Algumas funcionalidades foram planejadas, outras surgiram por necessidade e algumas nasceram de uma conversa às duas da manhã. 🌙",

    "A diferença entre um bug e uma funcionalidade é que, no segundo caso, já existe uma explicação convincente no comentário do código. 🤓",

    "Se você encontrou uma função que facilita sua rotina, use sem medo. Ela não vai ficar ofendida se você não souber como foi programada. Esse é o problema do desenvolvedor. 😅",

    // Motivacionais, mas com personalidade
    "Você não precisa resolver tudo de uma vez. Até o SIGC divide suas tarefas em funções. Respire, organize e vá por partes. 🧩",

    "Um dia sem erros é um ótimo dia. Um dia com erros resolvidos também. Um dia em que você não apagou o banco de dados por engano merece até certificado. 🏆",

    "O segredo da organização é simples: registrar as informações, conferir os dados e não depender exclusivamente da própria memória. O SIGC aprova esta mensagem. ✅",

    "Se a tarefa parece complicada, comece pelo primeiro passo. O sistema também não foi construído inteiro em um único clique. 🔨",

    "O progresso nem sempre aparece em grandes mudanças. Às vezes, é só um filtro que finalmente funciona ou um relatório que não corta mais os nomes. Pequenas vitórias! 🎉",

    "Você está fazendo um bom trabalho. E, se hoje não estiver tudo perfeito, tudo bem. Até os sistemas precisam de manutenção preventiva. 💙",

    "Mensagem motivacional oficial do SIGC: mantenha a calma, confira os dados e, se nada funcionar, leia a mensagem de erro antes de apertar o botão mais cinco vezes. 🧘",

    "O dia está correndo bem: nenhum cadastro duplicado, nenhum relatório misteriosamente vazio e nenhum desenvolvedor questionando suas escolhas de vida. Aproveite! 😌",

    "A organização de hoje é o tempo economizado de amanhã. E o tempo economizado pode ser usado para tarefas importantes, como descobrir quem inventou reuniões que poderiam ser mensagens. 📈",

    "Se você chegou até aqui, parabéns! O SIGC está funcionando e você está usando suas funcionalidades. Agora só falta convencer o computador de que hoje é sexta-feira. 🤖"
];
    
    $numFrases = COUNT($frases);
    $numAleatorio = rand(1,$numFrases);
    $escolha = $frases[$numAleatorio];
    
    return $escolha;
    
}