FROM nginx:1.25-alpine

# Define o diretório de trabalho
WORKDIR /etc/nginx

# Remove a configuração padrão para evitar conflitos
RUN rm /etc/nginx/conf.d/default.conf

# Copia sua configuração personalizada
COPY nginx.conf /etc/nginx/nginx.conf

# Expõe a porta 80 (apenas para documentação, o Nginx já faz isso)
EXPOSE 80

# Inicia o Nginx em primeiro plano (necessário para o Docker não fechar)
CMD ["nginx", "-g", "daemon off;"]