-- WARNING: This schema is for context only and is not meant to be run.
-- Table order and constraints may not be valid for execution.

CREATE TABLE public.SAAS_AgentesIA (
  id bigint GENERATED ALWAYS AS IDENTITY NOT NULL,
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  contaId uuid DEFAULT gen_random_uuid(),
  nome text,
  conexaoId bigint,
  instrucoes text,
  modelo text,
  criatividade real,
  maxCreditos bigint,
  ativo boolean,
  conhecimento jsonb,
  cor text,
  separarMensagens boolean,
  ouvirAudio boolean,
  analisarImagens boolean,
  aparecerDigitando boolean,
  pausarAtendimento boolean,
  qntMsgHistorico integer,
  agruparMensagens boolean,
  intervaloEntreMensagens integer,
  CRM jsonb,
  abrirAtendimento jsonb,
  notificarHumano jsonb,
  requisicaoHTTP jsonb,
  CONSTRAINT SAAS_AgentesIA_pkey PRIMARY KEY (id),
  CONSTRAINT SAAS_AgentesIA_contaId_fkey FOREIGN KEY (contaId) REFERENCES public.SAAS_Contas(id),
  CONSTRAINT SAAS_AgentesIA_conexaoId_fkey FOREIGN KEY (conexaoId) REFERENCES public.SAAS_Conexões(id)
);
CREATE TABLE public.SAAS_Campos_Personalizados (
  id bigint GENERATED ALWAYS AS IDENTITY NOT NULL,
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  nome text NOT NULL,
  descricao text,
  tipo text NOT NULL CHECK (tipo = ANY (ARRAY['texto'::text, 'numero'::text, 'data'::text, 'boolean'::text])),
  contaId uuid NOT NULL,
  CONSTRAINT SAAS_Campos_Personalizados_pkey PRIMARY KEY (id),
  CONSTRAINT SAAS_Campos_Personalizados_contaId_fkey FOREIGN KEY (contaId) REFERENCES public.SAAS_Contas(id)
);
CREATE TABLE public.SAAS_Cards_Quadros (
  id bigint GENERATED ALWAYS AS IDENTITY NOT NULL,
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  quadroId bigint,
  contatoId bigint,
  valor double precision,
  etapaQuadroId bigint,
  observacoes text,
  tarefas ARRAY,
  ordem smallint,
  nome text,
  contato text,
  CONSTRAINT SAAS_Cards_Quadros_pkey PRIMARY KEY (id),
  CONSTRAINT SAAS_Cards_Quadros_contatoId_fkey FOREIGN KEY (contatoId) REFERENCES public.SAAS_Contatos(id),
  CONSTRAINT SAAS_Cards_Quadros_etapaQuadroId_fkey FOREIGN KEY (etapaQuadroId) REFERENCES public.SAAS_Etapas_Quadros(id)
);
CREATE TABLE public.SAAS_Conexões (
  id bigint GENERATED ALWAYS AS IDENTITY NOT NULL,
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  instanceName text,
  NomeConexao text,
  Telefone text,
  FotoPerfil text,
  Apikey text,
  contaId uuid,
  idAgente bigint,
  CONSTRAINT SAAS_Conexões_pkey PRIMARY KEY (id),
  CONSTRAINT SAAS_Conexões_contaId_fkey FOREIGN KEY (contaId) REFERENCES public.SAAS_Contas(id),
  CONSTRAINT SAAS_Conexões_idAgente_fkey FOREIGN KEY (idAgente) REFERENCES public.SAAS_AgentesIA(id)
);
CREATE TABLE public.SAAS_Config_Emails (
  id integer NOT NULL DEFAULT 1 CHECK (id = 1),
  supabase_pat text,
  assunto_email_novousuario text,
  html_email_novousuario text,
  assunto_email_redefinirsenha text,
  html_email_redefinirsenha text,
  smtp_email text,
  smtp_name text,
  smtp_host text,
  smtp_port integer,
  smtp_user text,
  smtp_apikey text,
  updated_at timestamp with time zone DEFAULT now(),
  CONSTRAINT SAAS_Config_Emails_pkey PRIMARY KEY (id)
);
CREATE TABLE public.SAAS_Conhecimentos (
  id bigint GENERATED ALWAYS AS IDENTITY NOT NULL,
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  content text,
  metadata jsonb,
  embedding vector,
  CONSTRAINT SAAS_Conhecimentos_pkey PRIMARY KEY (id)
);
CREATE TABLE public.SAAS_Contas (
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  status boolean DEFAULT true,
  apikey_gpt text,
  id uuid NOT NULL DEFAULT gen_random_uuid(),
  dataValidade date,
  plano bigint,
  tokens numeric,
  email text,
  CONSTRAINT SAAS_Contas_pkey PRIMARY KEY (id),
  CONSTRAINT SAAS_Contas_plano_fkey FOREIGN KEY (plano) REFERENCES public.SAAS_Planos(id)
);
CREATE TABLE public.SAAS_Contatos (
  id bigint GENERATED ALWAYS AS IDENTITY NOT NULL,
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  nome text,
  telefone text,
  idLista bigint,
  variaveis jsonb NOT NULL DEFAULT '{}'::jsonb,
  contaId uuid NOT NULL,
  tipo text NOT NULL DEFAULT 'contato'::text CHECK (tipo = ANY (ARRAY['contato'::text, 'grupo'::text])),
  email text,
  lid text,
  fotoPerfil text,
  CONSTRAINT SAAS_Contatos_pkey PRIMARY KEY (id),
  CONSTRAINT SAAS_Contatos_contaId_fkey FOREIGN KEY (contaId) REFERENCES public.SAAS_Contas(id),
  CONSTRAINT SAAS_Contatos_idLista_fkey FOREIGN KEY (idLista) REFERENCES public.SAAS_Etiquetas(id)
);
CREATE TABLE public.SAAS_Contatos_Etiquetas (
  contatoId bigint NOT NULL,
  etiquetaId bigint NOT NULL,
  contaId uuid NOT NULL,
  CONSTRAINT SAAS_Contatos_Etiquetas_pkey PRIMARY KEY (contatoId, etiquetaId),
  CONSTRAINT SAAS_Contatos_Etiquetas_contatoId_fkey FOREIGN KEY (contatoId) REFERENCES public.SAAS_Contatos(id),
  CONSTRAINT SAAS_Contatos_Etiquetas_etiquetaId_fkey FOREIGN KEY (etiquetaId) REFERENCES public.SAAS_Etiquetas(id),
  CONSTRAINT SAAS_Contatos_Etiquetas_contaId_fkey FOREIGN KEY (contaId) REFERENCES public.SAAS_Contas(id)
);
CREATE TABLE public.SAAS_Conversas_Agentes (
  id bigint GENERATED ALWAYS AS IDENTITY NOT NULL,
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  idAgente bigint,
  idConexao bigint,
  telefone text,
  pausado boolean,
  pausaAte timestamp with time zone,
  ultimaMensagem timestamp with time zone,
  contaId uuid,
  contatoId bigint,
  lida boolean NOT NULL DEFAULT false,
  statusAtendimento text NOT NULL DEFAULT 'aguardando'::text,
  nomeConversa text,
  fotoPerfil text,
  dataFechamento timestamp with time zone,
  nota text,
  atendente uuid,
  CONSTRAINT SAAS_Conversas_Agentes_pkey PRIMARY KEY (id),
  CONSTRAINT SAAS_Conversas_Agentes_idAgente_fkey FOREIGN KEY (idAgente) REFERENCES public.SAAS_AgentesIA(id),
  CONSTRAINT SAAS_Conversas_Agentes_atendente_fkey FOREIGN KEY (atendente) REFERENCES public.SAAS_Usuarios(id),
  CONSTRAINT SAAS_Conversas_Agentes_contaId_fkey FOREIGN KEY (contaId) REFERENCES public.SAAS_Contas(id),
  CONSTRAINT SAAS_Conversas_Agentes_idConexao_fkey FOREIGN KEY (idConexao) REFERENCES public.SAAS_Conexões(id),
  CONSTRAINT SAAS_Conversas_Agentes_contatoId_fkey FOREIGN KEY (contatoId) REFERENCES public.SAAS_Contatos(id)
);
CREATE TABLE public.SAAS_Detalhes_Disparos (
  id bigint GENERATED ALWAYS AS IDENTITY NOT NULL,
  idDisparo bigint,
  idContato bigint,
  Mensagem text,
  idConexao bigint,
  dataEnvio timestamp with time zone,
  Status text,
  statusHttp text,
  mensagemErro text,
  respostaHttp jsonb,
  Payload jsonb,
  KeyRedis text,
  FakeCall boolean,
  CONSTRAINT SAAS_Detalhes_Disparos_pkey PRIMARY KEY (id),
  CONSTRAINT SAAS_Detalhes_Disparos_idConexao_fkey FOREIGN KEY (idConexao) REFERENCES public.SAAS_Conexões(id),
  CONSTRAINT SAAS_Detalhes_Disparos_idDisparo_fkey FOREIGN KEY (idDisparo) REFERENCES public.SAAS_Disparos(id),
  CONSTRAINT SAAS_Detalhes_Disparos_idContato_fkey FOREIGN KEY (idContato) REFERENCES public.SAAS_Contatos(id)
);
CREATE TABLE public.SAAS_Disparos (
  id bigint GENERATED ALWAYS AS IDENTITY NOT NULL,
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  Mensagens ARRAY,
  TipoDisparo text,
  TotalDisparos bigint,
  MensagensDisparadas bigint,
  StatusDisparo text,
  idExecution text,
  idListas ARRAY,
  idConexoes ARRAY,
  intervaloMin integer,
  intervaloMax integer,
  PausaAposMensagens integer,
  PausaMinutos integer,
  StartTime time without time zone,
  EndTime time without time zone,
  DiasSelecionados ARRAY,
  DataAgendamento timestamp with time zone,
  contaId uuid,
  idEtiquetas ARRAY,
  NomeDisparo text,
  CONSTRAINT SAAS_Disparos_pkey PRIMARY KEY (id),
  CONSTRAINT SAAS_Disparos_contaId_fkey FOREIGN KEY (contaId) REFERENCES public.SAAS_Contas(id)
);
CREATE TABLE public.SAAS_Etapas_Quadros (
  id bigint GENERATED ALWAYS AS IDENTITY NOT NULL,
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  quadroId bigint,
  nome text,
  ordem smallint,
  contaId uuid,
  CONSTRAINT SAAS_Etapas_Quadros_pkey PRIMARY KEY (id),
  CONSTRAINT SAAS_Etapas_Quadros_contaId_fkey FOREIGN KEY (contaId) REFERENCES public.SAAS_Contas(id),
  CONSTRAINT SAAS_Etapas_Quadros_quadroId_fkey FOREIGN KEY (quadroId) REFERENCES public.SAAS_Quadros(id)
);
CREATE TABLE public.SAAS_Etiquetas (
  id bigint GENERATED ALWAYS AS IDENTITY NOT NULL,
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  nome text NOT NULL,
  descricao text,
  contaId uuid NOT NULL,
  cor text,
  CONSTRAINT SAAS_Etiquetas_pkey PRIMARY KEY (id),
  CONSTRAINT SAAS_Listas_contaId_fkey FOREIGN KEY (contaId) REFERENCES public.SAAS_Contas(id)
);
CREATE TABLE public.SAAS_Historico_AgenteIA (
  id integer NOT NULL DEFAULT nextval('saas_historico_agenteia_id_seq'::regclass),
  session_id character varying NOT NULL,
  message jsonb NOT NULL,
  CONSTRAINT SAAS_Historico_AgenteIA_pkey PRIMARY KEY (id)
);
CREATE TABLE public.SAAS_IntegracaoPagamento (
  id bigint GENERATED ALWAYS AS IDENTITY NOT NULL,
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  nome text,
  planoId bigint,
  tokenWebhook uuid DEFAULT gen_random_uuid(),
  diasValidade integer,
  mapeamento jsonb,
  ultimoPayload jsonb,
  teste boolean DEFAULT false,
  status boolean DEFAULT true,
  CONSTRAINT SAAS_IntegracaoPagamento_pkey PRIMARY KEY (id),
  CONSTRAINT SAAS_IntegracaoPagamento_planoId_fkey FOREIGN KEY (planoId) REFERENCES public.SAAS_Planos(id)
);
CREATE TABLE public.SAAS_Mensagens (
  id bigint GENERATED ALWAYS AS IDENTITY NOT NULL,
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  contaId uuid NOT NULL,
  conexaoId bigint,
  conversaId bigint NOT NULL,
  mensagem text,
  tipoMensagem text NOT NULL,
  arquivoUrl text,
  fromMe boolean NOT NULL DEFAULT false,
  apagada boolean NOT NULL DEFAULT false,
  messageEvolutionId text,
  mensagemRespondida text,
  enviada boolean,
  IA boolean,
  favorita boolean NOT NULL DEFAULT false,
  CONSTRAINT SAAS_Mensagens_pkey PRIMARY KEY (id),
  CONSTRAINT saas_mensagens_contaid_fkey FOREIGN KEY (contaId) REFERENCES public.SAAS_Contas(id),
  CONSTRAINT SAAS_Mensagens_conversaId_fkey FOREIGN KEY (conversaId) REFERENCES public.SAAS_Conversas_Agentes(id)
);
CREATE TABLE public.SAAS_Planos (
  id bigint GENERATED ALWAYS AS IDENTITY NOT NULL,
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  nome text,
  preco real,
  qntConexoes bigint,
  qntContatos bigint,
  qntDisparos bigint,
  qntQuadros bigint,
  qntAgentesIa bigint,
  qntCreditosIa bigint,
  menu_ocultar jsonb DEFAULT '[]'::jsonb,
  qntUsuarios bigint,
  CONSTRAINT SAAS_Planos_pkey PRIMARY KEY (id)
);
CREATE TABLE public.SAAS_Quadros (
  id bigint GENERATED ALWAYS AS IDENTITY NOT NULL,
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  nome text,
  descricao text,
  cor text,
  contaId uuid DEFAULT gen_random_uuid(),
  icone text,
  CONSTRAINT SAAS_Quadros_pkey PRIMARY KEY (id),
  CONSTRAINT SAAS_Quadros_contaId_fkey FOREIGN KEY (contaId) REFERENCES public.SAAS_Contas(id)
);
CREATE TABLE public.SAAS_Resposta_Rapidas (
  id bigint GENERATED ALWAYS AS IDENTITY NOT NULL,
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  contaId uuid DEFAULT gen_random_uuid(),
  nome text,
  atalho text,
  texto text,
  arquivo text,
  tipoMedia text,
  CONSTRAINT SAAS_Resposta_Rapidas_pkey PRIMARY KEY (id),
  CONSTRAINT SAAS_Resposta_Rapidas_contaId_fkey FOREIGN KEY (contaId) REFERENCES public.SAAS_Contas(id)
);
CREATE TABLE public.SAAS_Usuarios (
  id uuid NOT NULL DEFAULT gen_random_uuid(),
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  contaId uuid,
  nome text,
  Email text,
  telefone text,
  auth_user_id uuid UNIQUE,
  funcao text NOT NULL DEFAULT 'admin'::text CHECK (funcao = ANY (ARRAY['admin'::text, 'membro'::text])),
  super_admin boolean NOT NULL DEFAULT false,
  CONSTRAINT SAAS_Usuarios_pkey PRIMARY KEY (id),
  CONSTRAINT SAAS_Usuarios_contaId_fkey FOREIGN KEY (contaId) REFERENCES public.SAAS_Contas(id)
);
CREATE TABLE public.SAAS_Valores_Campos_Personalizados (
  id bigint GENERATED ALWAYS AS IDENTITY NOT NULL,
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  idCampo bigint NOT NULL,
  idContato bigint NOT NULL,
  contaId uuid NOT NULL,
  valor text,
  CONSTRAINT SAAS_Valores_Campos_Personalizados_pkey PRIMARY KEY (id),
  CONSTRAINT SAAS_Valores_Campos_Personalizados_idCampo_fkey FOREIGN KEY (idCampo) REFERENCES public.SAAS_Campos_Personalizados(id),
  CONSTRAINT SAAS_Valores_Campos_Personalizados_idContato_fkey FOREIGN KEY (idContato) REFERENCES public.SAAS_Contatos(id),
  CONSTRAINT SAAS_Valores_Campos_Personalizados_contaId_fkey FOREIGN KEY (contaId) REFERENCES public.SAAS_Contas(id)
);
CREATE TABLE public.SAAS_Versao (
  id bigint GENERATED ALWAYS AS IDENTITY NOT NULL,
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  versaoAtual text,
  ultimaAtualizacao timestamp with time zone,
  CONSTRAINT SAAS_Versao_pkey PRIMARY KEY (id)
);
CREATE TABLE public.SAAS_Webhook (
  id bigint GENERATED ALWAYS AS IDENTITY NOT NULL,
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  contaId uuid DEFAULT gen_random_uuid(),
  conexaoId bigint,
  tokenWebhook uuid DEFAULT gen_random_uuid(),
  nome text,
  status boolean,
  teste boolean,
  mapeamento jsonb,
  ultimoPayload jsonb,
  idAgente bigint,
  mensagemPadrao text,
  CONSTRAINT SAAS_Webhook_pkey PRIMARY KEY (id),
  CONSTRAINT SAAS_Webhook_contaId_fkey FOREIGN KEY (contaId) REFERENCES public.SAAS_Contas(id),
  CONSTRAINT SAAS_Webhook_conexaoId_fkey FOREIGN KEY (conexaoId) REFERENCES public.SAAS_Conexões(id),
  CONSTRAINT SAAS_Webhook_idAgente_fkey FOREIGN KEY (idAgente) REFERENCES public.SAAS_AgentesIA(id)
);
CREATE TABLE public.saas_historico_agenteia (
  id integer NOT NULL DEFAULT nextval('saas_historico_agenteia_id_seq1'::regclass),
  session_id character varying NOT NULL,
  message jsonb NOT NULL,
  CONSTRAINT saas_historico_agenteia_pkey PRIMARY KEY (id)
);