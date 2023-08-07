PGDMP     $    $                {            hospital_sys_db    12.15    12.15 h    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    18939    hospital_sys_db    DATABASE     �   CREATE DATABASE hospital_sys_db WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_United States.1252' LC_CTYPE = 'English_United States.1252';
    DROP DATABASE hospital_sys_db;
                postgres    false            �            1259    19030    departments_tb    TABLE       CREATE TABLE public.departments_tb (
    department_id bigint NOT NULL,
    department_name character varying(50) NOT NULL,
    department_description character varying(50),
    created_at timestamp(1) without time zone,
    updated_at timestamp(1) without time zone
);
 "   DROP TABLE public.departments_tb;
       public         heap    postgres    false            �            1259    19028     departments_tb_department_id_seq    SEQUENCE     �   CREATE SEQUENCE public.departments_tb_department_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.departments_tb_department_id_seq;
       public          postgres    false    218            �           0    0     departments_tb_department_id_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.departments_tb_department_id_seq OWNED BY public.departments_tb.department_id;
          public          postgres    false    217            �            1259    19038    doctor_roles_tb    TABLE     �   CREATE TABLE public.doctor_roles_tb (
    doctor_role_id bigint NOT NULL,
    doctor_role_name character varying(15) NOT NULL,
    created_at timestamp(1) without time zone,
    updated_at timestamp(1) without time zone
);
 #   DROP TABLE public.doctor_roles_tb;
       public         heap    postgres    false            �            1259    19036 "   doctor_roles_tb_doctor_role_id_seq    SEQUENCE     �   CREATE SEQUENCE public.doctor_roles_tb_doctor_role_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.doctor_roles_tb_doctor_role_id_seq;
       public          postgres    false    220            �           0    0 "   doctor_roles_tb_doctor_role_id_seq    SEQUENCE OWNED BY     i   ALTER SEQUENCE public.doctor_roles_tb_doctor_role_id_seq OWNED BY public.doctor_roles_tb.doctor_role_id;
          public          postgres    false    219            �            1259    19046 
   doctors_tb    TABLE     H  CREATE TABLE public.doctors_tb (
    doctor_id bigint NOT NULL,
    doctor_name character varying(50) NOT NULL,
    doctor_address character varying(250) NOT NULL,
    doctor_phone character varying(50) NOT NULL,
    doctor_email character varying(50) NOT NULL,
    doctor_profile character varying(50),
    doctor_password character varying(250),
    doctor_pob character varying(250),
    doctor_dob date NOT NULL,
    department_id bigint NOT NULL,
    doctor_role_id bigint NOT NULL,
    created_at timestamp(1) without time zone,
    updated_at timestamp(1) without time zone
);
    DROP TABLE public.doctors_tb;
       public         heap    postgres    false            �            1259    19044    doctors_tb_doctor_id_seq    SEQUENCE     �   CREATE SEQUENCE public.doctors_tb_doctor_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.doctors_tb_doctor_id_seq;
       public          postgres    false    222            �           0    0    doctors_tb_doctor_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.doctors_tb_doctor_id_seq OWNED BY public.doctors_tb.doctor_id;
          public          postgres    false    221            �            1259    18970    failed_jobs    TABLE     &  CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap    postgres    false            �            1259    18968    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public          postgres    false    208            �           0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
          public          postgres    false    207            �            1259    18942 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    postgres    false            �            1259    18940    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          postgres    false    203            �           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          postgres    false    202            �            1259    18961    password_resets    TABLE     �   CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 #   DROP TABLE public.password_resets;
       public         heap    postgres    false            �            1259    19067    patients_tb    TABLE       CREATE TABLE public.patients_tb (
    patient_id bigint NOT NULL,
    patient_name character varying(50) NOT NULL,
    patient_email character varying(50),
    patient_address character varying(250) NOT NULL,
    patient_phone character varying(50) NOT NULL,
    patient_sex character varying(10),
    patient_blood_group character varying(5),
    patient_dob date,
    doctor_id bigint NOT NULL,
    receptionist_id bigint NOT NULL,
    created_at timestamp(1) without time zone,
    updated_at timestamp(1) without time zone
);
    DROP TABLE public.patients_tb;
       public         heap    postgres    false            �            1259    19065    patients_tb_patient_id_seq    SEQUENCE     �   CREATE SEQUENCE public.patients_tb_patient_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.patients_tb_patient_id_seq;
       public          postgres    false    224            �           0    0    patients_tb_patient_id_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.patients_tb_patient_id_seq OWNED BY public.patients_tb.patient_id;
          public          postgres    false    223            �            1259    18998    payment_methods_tb    TABLE     �   CREATE TABLE public.payment_methods_tb (
    payment_method_id bigint NOT NULL,
    payment_method_name character varying(50) NOT NULL,
    created_at timestamp(1) without time zone,
    updated_at timestamp(1) without time zone
);
 &   DROP TABLE public.payment_methods_tb;
       public         heap    postgres    false            �            1259    18996 (   payment_methods_tb_payment_method_id_seq    SEQUENCE     �   CREATE SEQUENCE public.payment_methods_tb_payment_method_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ?   DROP SEQUENCE public.payment_methods_tb_payment_method_id_seq;
       public          postgres    false    212            �           0    0 (   payment_methods_tb_payment_method_id_seq    SEQUENCE OWNED BY     u   ALTER SEQUENCE public.payment_methods_tb_payment_method_id_seq OWNED BY public.payment_methods_tb.payment_method_id;
          public          postgres    false    211            �            1259    19085    payments_tb    TABLE     W  CREATE TABLE public.payments_tb (
    payment_id bigint NOT NULL,
    payment_amount numeric(9,3) NOT NULL,
    payment_method_id bigint NOT NULL,
    receptionist_id bigint NOT NULL,
    patient_id bigint NOT NULL,
    doctor_id bigint NOT NULL,
    created_at timestamp(1) without time zone,
    updated_at timestamp(1) without time zone
);
    DROP TABLE public.payments_tb;
       public         heap    postgres    false            �            1259    19083    payments_tb_payment_id_seq    SEQUENCE     �   CREATE SEQUENCE public.payments_tb_payment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.payments_tb_payment_id_seq;
       public          postgres    false    226            �           0    0    payments_tb_payment_id_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.payments_tb_payment_id_seq OWNED BY public.payments_tb.payment_id;
          public          postgres    false    225            �            1259    18984    personal_access_tokens    TABLE     �  CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 *   DROP TABLE public.personal_access_tokens;
       public         heap    postgres    false            �            1259    18982    personal_access_tokens_id_seq    SEQUENCE     �   CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.personal_access_tokens_id_seq;
       public          postgres    false    210            �           0    0    personal_access_tokens_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;
          public          postgres    false    209            �            1259    19006    receptionist_roles_tb    TABLE     �   CREATE TABLE public.receptionist_roles_tb (
    receptionist_role_id bigint NOT NULL,
    receptionist_role_name character varying(30) NOT NULL,
    created_at timestamp(1) without time zone,
    updated_at timestamp(1) without time zone
);
 )   DROP TABLE public.receptionist_roles_tb;
       public         heap    postgres    false            �            1259    19004 .   receptionist_roles_tb_receptionist_role_id_seq    SEQUENCE     �   CREATE SEQUENCE public.receptionist_roles_tb_receptionist_role_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 E   DROP SEQUENCE public.receptionist_roles_tb_receptionist_role_id_seq;
       public          postgres    false    214            �           0    0 .   receptionist_roles_tb_receptionist_role_id_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.receptionist_roles_tb_receptionist_role_id_seq OWNED BY public.receptionist_roles_tb.receptionist_role_id;
          public          postgres    false    213            �            1259    19014    receptionist_tb    TABLE       CREATE TABLE public.receptionist_tb (
    receptionist_id bigint NOT NULL,
    receptionist_name character varying(30) NOT NULL,
    receptionist_address character varying(150),
    receptionist_phone character varying(20),
    receptionist_email character varying(50) NOT NULL,
    receptionist_profile character varying(250),
    receptionist_password character varying(250) NOT NULL,
    receptionist_role_id bigint NOT NULL,
    created_at timestamp(1) without time zone,
    updated_at timestamp(1) without time zone
);
 #   DROP TABLE public.receptionist_tb;
       public         heap    postgres    false            �            1259    19012 #   receptionist_tb_receptionist_id_seq    SEQUENCE     �   CREATE SEQUENCE public.receptionist_tb_receptionist_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 :   DROP SEQUENCE public.receptionist_tb_receptionist_id_seq;
       public          postgres    false    216            �           0    0 #   receptionist_tb_receptionist_id_seq    SEQUENCE OWNED BY     k   ALTER SEQUENCE public.receptionist_tb_receptionist_id_seq OWNED BY public.receptionist_tb.receptionist_id;
          public          postgres    false    215            �            1259    18950    users    TABLE     x  CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    18948    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    205            �           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    204            �
           2604    19033    departments_tb department_id    DEFAULT     �   ALTER TABLE ONLY public.departments_tb ALTER COLUMN department_id SET DEFAULT nextval('public.departments_tb_department_id_seq'::regclass);
 K   ALTER TABLE public.departments_tb ALTER COLUMN department_id DROP DEFAULT;
       public          postgres    false    217    218    218            �
           2604    19041    doctor_roles_tb doctor_role_id    DEFAULT     �   ALTER TABLE ONLY public.doctor_roles_tb ALTER COLUMN doctor_role_id SET DEFAULT nextval('public.doctor_roles_tb_doctor_role_id_seq'::regclass);
 M   ALTER TABLE public.doctor_roles_tb ALTER COLUMN doctor_role_id DROP DEFAULT;
       public          postgres    false    219    220    220            �
           2604    19049    doctors_tb doctor_id    DEFAULT     |   ALTER TABLE ONLY public.doctors_tb ALTER COLUMN doctor_id SET DEFAULT nextval('public.doctors_tb_doctor_id_seq'::regclass);
 C   ALTER TABLE public.doctors_tb ALTER COLUMN doctor_id DROP DEFAULT;
       public          postgres    false    221    222    222            �
           2604    18973    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    207    208    208            �
           2604    18945    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    203    202    203            �
           2604    19070    patients_tb patient_id    DEFAULT     �   ALTER TABLE ONLY public.patients_tb ALTER COLUMN patient_id SET DEFAULT nextval('public.patients_tb_patient_id_seq'::regclass);
 E   ALTER TABLE public.patients_tb ALTER COLUMN patient_id DROP DEFAULT;
       public          postgres    false    224    223    224            �
           2604    19001 $   payment_methods_tb payment_method_id    DEFAULT     �   ALTER TABLE ONLY public.payment_methods_tb ALTER COLUMN payment_method_id SET DEFAULT nextval('public.payment_methods_tb_payment_method_id_seq'::regclass);
 S   ALTER TABLE public.payment_methods_tb ALTER COLUMN payment_method_id DROP DEFAULT;
       public          postgres    false    211    212    212            �
           2604    19088    payments_tb payment_id    DEFAULT     �   ALTER TABLE ONLY public.payments_tb ALTER COLUMN payment_id SET DEFAULT nextval('public.payments_tb_payment_id_seq'::regclass);
 E   ALTER TABLE public.payments_tb ALTER COLUMN payment_id DROP DEFAULT;
       public          postgres    false    226    225    226            �
           2604    18987    personal_access_tokens id    DEFAULT     �   ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);
 H   ALTER TABLE public.personal_access_tokens ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    210    209    210            �
           2604    19009 *   receptionist_roles_tb receptionist_role_id    DEFAULT     �   ALTER TABLE ONLY public.receptionist_roles_tb ALTER COLUMN receptionist_role_id SET DEFAULT nextval('public.receptionist_roles_tb_receptionist_role_id_seq'::regclass);
 Y   ALTER TABLE public.receptionist_roles_tb ALTER COLUMN receptionist_role_id DROP DEFAULT;
       public          postgres    false    213    214    214            �
           2604    19017    receptionist_tb receptionist_id    DEFAULT     �   ALTER TABLE ONLY public.receptionist_tb ALTER COLUMN receptionist_id SET DEFAULT nextval('public.receptionist_tb_receptionist_id_seq'::regclass);
 N   ALTER TABLE public.receptionist_tb ALTER COLUMN receptionist_id DROP DEFAULT;
       public          postgres    false    216    215    216            �
           2604    18953    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    204    205    205            �          0    19030    departments_tb 
   TABLE DATA           x   COPY public.departments_tb (department_id, department_name, department_description, created_at, updated_at) FROM stdin;
    public          postgres    false    218   k�       �          0    19038    doctor_roles_tb 
   TABLE DATA           c   COPY public.doctor_roles_tb (doctor_role_id, doctor_role_name, created_at, updated_at) FROM stdin;
    public          postgres    false    220   �       �          0    19046 
   doctors_tb 
   TABLE DATA           �   COPY public.doctors_tb (doctor_id, doctor_name, doctor_address, doctor_phone, doctor_email, doctor_profile, doctor_password, doctor_pob, doctor_dob, department_id, doctor_role_id, created_at, updated_at) FROM stdin;
    public          postgres    false    222   &�       �          0    18970    failed_jobs 
   TABLE DATA           a   COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
    public          postgres    false    208   S�       �          0    18942 
   migrations 
   TABLE DATA           :   COPY public.migrations (id, migration, batch) FROM stdin;
    public          postgres    false    203   p�       �          0    18961    password_resets 
   TABLE DATA           C   COPY public.password_resets (email, token, created_at) FROM stdin;
    public          postgres    false    206   _�       �          0    19067    patients_tb 
   TABLE DATA           �   COPY public.patients_tb (patient_id, patient_name, patient_email, patient_address, patient_phone, patient_sex, patient_blood_group, patient_dob, doctor_id, receptionist_id, created_at, updated_at) FROM stdin;
    public          postgres    false    224   |�       �          0    18998    payment_methods_tb 
   TABLE DATA           l   COPY public.payment_methods_tb (payment_method_id, payment_method_name, created_at, updated_at) FROM stdin;
    public          postgres    false    212   Ɏ       �          0    19085    payments_tb 
   TABLE DATA           �   COPY public.payments_tb (payment_id, payment_amount, payment_method_id, receptionist_id, patient_id, doctor_id, created_at, updated_at) FROM stdin;
    public          postgres    false    226   �       �          0    18984    personal_access_tokens 
   TABLE DATA           �   COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) FROM stdin;
    public          postgres    false    210   ,�       �          0    19006    receptionist_roles_tb 
   TABLE DATA           u   COPY public.receptionist_roles_tb (receptionist_role_id, receptionist_role_name, created_at, updated_at) FROM stdin;
    public          postgres    false    214   I�       �          0    19014    receptionist_tb 
   TABLE DATA           �   COPY public.receptionist_tb (receptionist_id, receptionist_name, receptionist_address, receptionist_phone, receptionist_email, receptionist_profile, receptionist_password, receptionist_role_id, created_at, updated_at) FROM stdin;
    public          postgres    false    216   ��       �          0    18950    users 
   TABLE DATA           u   COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
    public          postgres    false    205   X�       �           0    0     departments_tb_department_id_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('public.departments_tb_department_id_seq', 5, true);
          public          postgres    false    217            �           0    0 "   doctor_roles_tb_doctor_role_id_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('public.doctor_roles_tb_doctor_role_id_seq', 2, true);
          public          postgres    false    219            �           0    0    doctors_tb_doctor_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.doctors_tb_doctor_id_seq', 4, true);
          public          postgres    false    221            �           0    0    failed_jobs_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);
          public          postgres    false    207            �           0    0    migrations_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.migrations_id_seq', 12, true);
          public          postgres    false    202            �           0    0    patients_tb_patient_id_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.patients_tb_patient_id_seq', 2, true);
          public          postgres    false    223            �           0    0 (   payment_methods_tb_payment_method_id_seq    SEQUENCE SET     V   SELECT pg_catalog.setval('public.payment_methods_tb_payment_method_id_seq', 2, true);
          public          postgres    false    211            �           0    0    payments_tb_payment_id_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.payments_tb_payment_id_seq', 1, false);
          public          postgres    false    225            �           0    0    personal_access_tokens_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);
          public          postgres    false    209            �           0    0 .   receptionist_roles_tb_receptionist_role_id_seq    SEQUENCE SET     \   SELECT pg_catalog.setval('public.receptionist_roles_tb_receptionist_role_id_seq', 2, true);
          public          postgres    false    213            �           0    0 #   receptionist_tb_receptionist_id_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public.receptionist_tb_receptionist_id_seq', 1, true);
          public          postgres    false    215            �           0    0    users_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.users_id_seq', 1, false);
          public          postgres    false    204            �
           2606    19035 "   departments_tb departments_tb_pkey 
   CONSTRAINT     k   ALTER TABLE ONLY public.departments_tb
    ADD CONSTRAINT departments_tb_pkey PRIMARY KEY (department_id);
 L   ALTER TABLE ONLY public.departments_tb DROP CONSTRAINT departments_tb_pkey;
       public            postgres    false    218            �
           2606    19043 $   doctor_roles_tb doctor_roles_tb_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.doctor_roles_tb
    ADD CONSTRAINT doctor_roles_tb_pkey PRIMARY KEY (doctor_role_id);
 N   ALTER TABLE ONLY public.doctor_roles_tb DROP CONSTRAINT doctor_roles_tb_pkey;
       public            postgres    false    220            �
           2606    19054    doctors_tb doctors_tb_pkey 
   CONSTRAINT     _   ALTER TABLE ONLY public.doctors_tb
    ADD CONSTRAINT doctors_tb_pkey PRIMARY KEY (doctor_id);
 D   ALTER TABLE ONLY public.doctors_tb DROP CONSTRAINT doctors_tb_pkey;
       public            postgres    false    222            �
           2606    18979    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public            postgres    false    208            �
           2606    18981 #   failed_jobs failed_jobs_uuid_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
 M   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
       public            postgres    false    208            �
           2606    18947    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            postgres    false    203            �
           2606    19072    patients_tb patients_tb_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.patients_tb
    ADD CONSTRAINT patients_tb_pkey PRIMARY KEY (patient_id);
 F   ALTER TABLE ONLY public.patients_tb DROP CONSTRAINT patients_tb_pkey;
       public            postgres    false    224            �
           2606    19003 *   payment_methods_tb payment_methods_tb_pkey 
   CONSTRAINT     w   ALTER TABLE ONLY public.payment_methods_tb
    ADD CONSTRAINT payment_methods_tb_pkey PRIMARY KEY (payment_method_id);
 T   ALTER TABLE ONLY public.payment_methods_tb DROP CONSTRAINT payment_methods_tb_pkey;
       public            postgres    false    212            �
           2606    19090    payments_tb payments_tb_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.payments_tb
    ADD CONSTRAINT payments_tb_pkey PRIMARY KEY (payment_id);
 F   ALTER TABLE ONLY public.payments_tb DROP CONSTRAINT payments_tb_pkey;
       public            postgres    false    226            �
           2606    18992 2   personal_access_tokens personal_access_tokens_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);
 \   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_pkey;
       public            postgres    false    210            �
           2606    18995 :   personal_access_tokens personal_access_tokens_token_unique 
   CONSTRAINT     v   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);
 d   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_token_unique;
       public            postgres    false    210            �
           2606    19011 0   receptionist_roles_tb receptionist_roles_tb_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.receptionist_roles_tb
    ADD CONSTRAINT receptionist_roles_tb_pkey PRIMARY KEY (receptionist_role_id);
 Z   ALTER TABLE ONLY public.receptionist_roles_tb DROP CONSTRAINT receptionist_roles_tb_pkey;
       public            postgres    false    214            �
           2606    19022 $   receptionist_tb receptionist_tb_pkey 
   CONSTRAINT     o   ALTER TABLE ONLY public.receptionist_tb
    ADD CONSTRAINT receptionist_tb_pkey PRIMARY KEY (receptionist_id);
 N   ALTER TABLE ONLY public.receptionist_tb DROP CONSTRAINT receptionist_tb_pkey;
       public            postgres    false    216            �
           2606    18960    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            postgres    false    205            �
           2606    18958    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    205            �
           1259    18967    password_resets_email_index    INDEX     X   CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);
 /   DROP INDEX public.password_resets_email_index;
       public            postgres    false    206            �
           1259    18993 8   personal_access_tokens_tokenable_type_tokenable_id_index    INDEX     �   CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);
 L   DROP INDEX public.personal_access_tokens_tokenable_type_tokenable_id_index;
       public            postgres    false    210    210            �
           2606    19055 +   doctors_tb doctors_tb_department_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.doctors_tb
    ADD CONSTRAINT doctors_tb_department_id_foreign FOREIGN KEY (department_id) REFERENCES public.departments_tb(department_id);
 U   ALTER TABLE ONLY public.doctors_tb DROP CONSTRAINT doctors_tb_department_id_foreign;
       public          postgres    false    218    2799    222            �
           2606    19060 ,   doctors_tb doctors_tb_doctor_role_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.doctors_tb
    ADD CONSTRAINT doctors_tb_doctor_role_id_foreign FOREIGN KEY (doctor_role_id) REFERENCES public.doctor_roles_tb(doctor_role_id);
 V   ALTER TABLE ONLY public.doctors_tb DROP CONSTRAINT doctors_tb_doctor_role_id_foreign;
       public          postgres    false    222    220    2801            �
           2606    19073 )   patients_tb patients_tb_doctor_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.patients_tb
    ADD CONSTRAINT patients_tb_doctor_id_foreign FOREIGN KEY (doctor_id) REFERENCES public.doctors_tb(doctor_id);
 S   ALTER TABLE ONLY public.patients_tb DROP CONSTRAINT patients_tb_doctor_id_foreign;
       public          postgres    false    2803    222    224            �
           2606    19078 /   patients_tb patients_tb_receptionist_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.patients_tb
    ADD CONSTRAINT patients_tb_receptionist_id_foreign FOREIGN KEY (receptionist_id) REFERENCES public.receptionist_tb(receptionist_id);
 Y   ALTER TABLE ONLY public.patients_tb DROP CONSTRAINT patients_tb_receptionist_id_foreign;
       public          postgres    false    216    224    2797                        2606    19106 )   payments_tb payments_tb_doctor_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.payments_tb
    ADD CONSTRAINT payments_tb_doctor_id_foreign FOREIGN KEY (doctor_id) REFERENCES public.doctors_tb(doctor_id);
 S   ALTER TABLE ONLY public.payments_tb DROP CONSTRAINT payments_tb_doctor_id_foreign;
       public          postgres    false    2803    222    226            �
           2606    19101 *   payments_tb payments_tb_patient_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.payments_tb
    ADD CONSTRAINT payments_tb_patient_id_foreign FOREIGN KEY (patient_id) REFERENCES public.patients_tb(patient_id);
 T   ALTER TABLE ONLY public.payments_tb DROP CONSTRAINT payments_tb_patient_id_foreign;
       public          postgres    false    224    2805    226            �
           2606    19091 1   payments_tb payments_tb_payment_method_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.payments_tb
    ADD CONSTRAINT payments_tb_payment_method_id_foreign FOREIGN KEY (payment_method_id) REFERENCES public.payment_methods_tb(payment_method_id);
 [   ALTER TABLE ONLY public.payments_tb DROP CONSTRAINT payments_tb_payment_method_id_foreign;
       public          postgres    false    226    212    2793            �
           2606    19096 /   payments_tb payments_tb_receptionist_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.payments_tb
    ADD CONSTRAINT payments_tb_receptionist_id_foreign FOREIGN KEY (receptionist_id) REFERENCES public.receptionist_tb(receptionist_id);
 Y   ALTER TABLE ONLY public.payments_tb DROP CONSTRAINT payments_tb_receptionist_id_foreign;
       public          postgres    false    216    2797    226            �
           2606    19023 <   receptionist_tb receptionist_tb_receptionist_role_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.receptionist_tb
    ADD CONSTRAINT receptionist_tb_receptionist_role_id_foreign FOREIGN KEY (receptionist_role_id) REFERENCES public.receptionist_roles_tb(receptionist_role_id);
 f   ALTER TABLE ONLY public.receptionist_tb DROP CONSTRAINT receptionist_tb_receptionist_role_id_foreign;
       public          postgres    false    216    2795    214            �   f   x�u��	�0@�s2�(iL�v'�h@*h/n� ��?@Y��<�--ņ$������~	k��`��`�
T���D�k�p�s/�r�T0w���}5k      �   5   x�3�L�O.�/�4202�5��50W00�20�24�&�eę����G��=... lZ�      �     x�m�MO�@Eׯ�b,i���BYi�B@��a3�-S竴S~��.�	�ݼ���{�\Uj͍Bu�9`B�(�.����b��F�n=z��[��5+�m��{#��[�����A��N���v�M�z��橽;LNⓂ`�6(ơO��C @�IC�|<D8c<�[����F�9���`�JHf���}$8�ȚN
Ӊ>Zr���N
�+{��2�&��nʕ�\�e_WYP��T-γ�����׃k��וi���Y�\ēS,:xc��)D��A���xLox��|n7      �      x������ � �      �   �   x�m�ю� ���1�Z�_�L�Yw���ٿ_l(�>��� ')�C��C�I3�#��zZ���B�tO�-z
ę�;Q(�ς�����o7�x����w�8���ĭzAm�H��Y�Q�ŀ2��Wy��V�;񗳑LI]*5��ϓ��g�΁ѻ�
8TPſ��Q�Zڴ�}dQ2֢M%�v�����Ҕq8���l<׋@��NT�\��i� �ٿ�      �      x������ � �      �   =   x�3�I-.1���,(�42464"�4� �pBX\�`�F �w 'Xq�b������ kJ�      �   6   x�3�LN,��4202�5��50W00�20�24�&�e��pޔ����zb���� �      �      x������ � �      �      x������ � �      �   =   x�3�,JMN-(����,.�4202�5��50W00�20�24�&�eę�����ZD��=... �
      �   �   x�m̻�0 й|�Ŕ�����%&.��^z����Fg�3�������F:pڠ��Dl�Q҂�'z�$�RInd�5��A�Q�{�ͨ���vF��/?�~������_�x���5q���t��f�ӤԷs9Om�\������k2�E�8�}��a7v��]ڞ�} �l<�      �      x������ � �     