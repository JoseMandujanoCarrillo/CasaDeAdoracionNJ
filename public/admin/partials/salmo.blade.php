<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Visor de Capítulos de la Biblia</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary-color: #4a6da7;
      --accent-color: #f9a826;
      --text-color: #333;
      --bg-color: #f9f9f9;
      --card-bg: #fff;
      --border-radius: 8px;
      --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      --transition: all 0.3s ease;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: var(--text-color);
      background: var(--bg-color);
      line-height: 1.6;
      padding: 0 1rem;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 2rem 1rem;
    }

    header {
      text-align: center;
      margin-bottom: 2rem;
    }

    h1 {
      color: var(--primary-color);
      font-size: 2.5rem;
      margin-bottom: 0.5rem;
      font-weight: 700;
    }

    .subtitle {
      color: #666;
      font-size: 1.1rem;
      margin-bottom: 1.5rem;
    }

    .search-container {
      background: var(--card-bg);
      padding: 1.5rem;
      border-radius: var(--border-radius);
      box-shadow: var(--shadow);
      margin-bottom: 2rem;
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .search-header {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: var(--primary-color);
    }

    .search-form {
      display: flex;
      gap: 0.75rem;
      flex-wrap: wrap;
    }

    .input-group {
      flex: 1;
      min-width: 200px;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: #555;
    }

    input {
      width: 100%;
      padding: 0.75rem 1rem;
      border: 1px solid #ddd;
      border-radius: var(--border-radius);
      font-size: 1rem;
      transition: var(--transition);
    }

    input:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(74, 109, 167, 0.2);
    }

    button {
      background-color: var(--primary-color);
      color: white;
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: var(--border-radius);
      cursor: pointer;
      font-size: 1rem;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      transition: var(--transition);
    }

    button:hover {
      background-color: #3a5a8f;
      transform: translateY(-2px);
    }

    .examples {
      margin-top: 0.75rem;
      font-size: 0.9rem;
      color: #666;
    }

    .examples code {
      background: #f2f2f2;
      padding: 0.15rem 0.4rem;
      border-radius: 4px;
      margin: 0 0.2rem;
      font-size: 0.85rem;
      cursor: pointer;
      color: var(--primary-color);
      transition: var(--transition);
    }

    .examples code:hover {
      background: #e6e6e6;
    }

    .result-container {
      background: var(--card-bg);
      border-radius: var(--border-radius);
      box-shadow: var(--shadow);
      overflow: hidden;
    }

    .result-header {
      background-color: var(--primary-color);
      color: white;
      padding: 1rem 1.5rem;
      font-weight: 500;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .result-title {
      font-size: 1.1rem;
    }

    .result-content {
      padding: 1.5rem;
      white-space: pre-wrap;
      line-height: 1.8;
      font-size: 1.05rem;
      max-height: 500px;
      overflow-y: auto;
    }

    .result-content:empty::before {
      content: "Aquí se mostrará la lectura del capítulo seleccionado";
      color: #999;
      font-style: italic;
    }

    .result-content.loading {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 200px;
    }

    .loader {
      border: 4px solid rgba(74, 109, 167, 0.3);
      border-top: 4px solid var(--primary-color);
      border-radius: 50%;
      width: 40px;
      height: 40px;
      animation: spin 1s linear infinite;
    }

    .error-message {
      color: #d9534f;
      padding: 1rem;
      border-left: 4px solid #d9534f;
      background-color: rgba(217, 83, 79, 0.1);
    }

    .quick-refs {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      margin-top: 1rem;
    }

    .quick-ref {
      background: #f2f2f2;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.9rem;
      cursor: pointer;
      transition: var(--transition);
    }

    .quick-ref:hover {
      background: #e6e6e6;
      transform: translateY(-2px);
    }

    .btn-copy {
      background: none;
      border: none;
      color: white;
      padding: 0.25rem;
      cursor: pointer;
      transition: var(--transition);
    }

    .btn-copy:hover {
      opacity: 0.8;
      transform: none;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    footer {
      text-align: center;
      margin-top: 2rem;
      padding: 1rem 0;
      color: #777;
      font-size: 0.9rem;
    }

    @media (max-width: 600px) {
      .search-form {
        flex-direction: column;
      }
      
      button {
        width: 100%;
        justify-content: center;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h1>Visor de Capítulos de la Biblia</h1>
      <p class="subtitle">Explora las escrituras con facilidad</p>
    </header>

    <main>
      <div class="search-container">
        <div class="search-header">
          <i class="fas fa-search"></i>
          <span>Buscar capítulo</span>
        </div>
        <div class="search-form">
          <div class="input-group">
              <label for="tipo">Selecciona el tipo de búsqueda:</label>
              <select id="tipo" class="form-control">
                  <option value="capitulo">Capítulo completo</option>
                  <option value="versiculo">Un solo versículo</option>
                  <option value="rango">Rango de versículos</option>
              </select>
          </div>
      
          <div class="input-group">
              <label for="capitulo">Referencia:</label>
              <div style="display: flex; align-items: center;">
                  <span style="padding: 0.75rem 1rem; background: #f2f2f2; border: 1px solid #ddd; border-radius: 8px 0 0 8px; font-weight: bold;">psa.</span>
                  <input type="text" id="capitulo" value="1" placeholder="Ej: 1, 1.3, 1.3-1.5" style="border-radius: 0 8px 8px 0;" />
              </div>
          </div>
      
          <button id="btnCargar">
              <i class="fas fa-book-open"></i>
              <span>Cargar</span>
          </button>
      </div>
      </div>

      <div class="result-container">
        <div class="result-header">
          <div class="result-title">Contenido del capítulo</div>
          <button id="btnCopiar" class="btn-copy" title="Copiar al portapapeles">
            <i class="fas fa-copy"></i>
          </button>
        </div>
        <div id="resultado" class="result-content"></div>
      </div>
    </main>

    <footer>
      © 2025 Visor de Capítulos de la Biblia | Utilizando la API de Scripture.api.bible
    </footer>
  </div>

  <script>
    const API_KEY = 'eb7a9aa09923bf71df88e1f36e6df98f';  // <- Sustituye con tu api-key
    const BIBLE_ID = '48acedcf8595c754-02';
    const resultadoDiv = document.getElementById('resultado');
    const inputCapitulo = document.getElementById('capitulo');
    const btn = document.getElementById('btnCargar');
    const btnCopiar = document.getElementById('btnCopiar');
    let currentContent = '';

    // Función para cargar el capítulo
    function cargarCapitulo(ref) {
    const reference = `psa.${ref.trim()}`; // Agrega el prefijo "psa."
    if (!ref.trim()) {
        mostrarError('Por favor, introduce un número de capítulo válido.');
        return;
    }

    // Mostrar el cargador
    resultadoDiv.innerHTML = '';
    resultadoDiv.classList.add('loading');
    const loader = document.createElement('div');
    loader.className = 'loader';
    resultadoDiv.appendChild(loader);

    const url = `https://api.scripture.api.bible/v1/bibles/${BIBLE_ID}/chapters/${reference}` +
                `?content-type=html&include-notes=false&include-titles=true` +
                `&include-chapter-numbers=false&include-verse-numbers=true&include-verse-spans=false`;

    fetch(url, {
        headers: {
            'api-key': API_KEY,
            'Accept': 'application/json'
        }
    })
    .then(resp => {
        if (!resp.ok) throw new Error(`Error ${resp.status}: ${resp.statusText}`);
        return resp.json();
    })
    .then(data => {
        // Quitar el cargador
        resultadoDiv.classList.remove('loading');
        
        // Obtenemos el contenido HTML
        const html = data.data.content;
        // Parseamos y extraemos sólo el texto de cada párrafo
        const tmp = document.createElement('div');
        tmp.innerHTML = html;
        const versos = Array.from(tmp.querySelectorAll('p'))
            .filter(p => p.innerText.trim().length > 0)
            .map(p => p.innerText.trim())
            .join('\n\n');
        
        // Actualizamos la variable de contenido actual
        currentContent = versos;
        
        // Mostramos como texto plano
        resultadoDiv.textContent = versos;
        
        // Actualizamos el título del resultado
        document.querySelector('.result-title').textContent = 
            `${data.data.reference} - ${data.data.bookname}`;
        
        // Guardar el Salmo en localStorage si pertenece al libro de los Salmos
        const psalmData = {
            reference: data.data.reference,
            book: data.data.bookname,
            verses: versos
        };
        localStorage.setItem('salmoSemana', JSON.stringify(psalmData));
    })
    .catch(err => {
        resultadoDiv.classList.remove('loading');
        mostrarError(`Error al cargar: ${err.message}`);
    });
}    function mostrarError(mensaje) {
      resultadoDiv.classList.remove('loading');
      resultadoDiv.innerHTML = `<div class="error-message">
        <i class="fas fa-exclamation-circle"></i> ${mensaje}
      </div>`;
    }

    // Función para copiar el contenido al portapapeles
    function copiarAlPortapapeles() {
      if (!currentContent) return;
      
      navigator.clipboard.writeText(currentContent)
        .then(() => {
          // Feedback visual
          const originalIcon = btnCopiar.innerHTML;
          btnCopiar.innerHTML = '<i class="fas fa-check"></i>';
          setTimeout(() => {
            btnCopiar.innerHTML = originalIcon;
          }, 2000);
        })
        .catch(err => {
          console.error('Error al copiar:', err);
        });
    }

    // Event listeners
    btn.addEventListener('click', () => cargarCapitulo(inputCapitulo.value));
    btnCopiar.addEventListener('click', copiarAlPortapapeles);
    
    // Event listeners para los ejemplos
    document.querySelectorAll('code[data-ref]').forEach(el => {
      el.addEventListener('click', () => {
        const ref = el.getAttribute('data-ref');
        inputCapitulo.value = ref;
        cargarCapitulo(ref);
      });
    });
    
    // Event listeners para referencias rápidas
    document.querySelectorAll('.quick-ref').forEach(el => {
      el.addEventListener('click', () => {
        const ref = el.getAttribute('data-ref');
        inputCapitulo.value = ref;
        cargarCapitulo(ref);
      });
    });

    // Permitir enviar el formulario presionando Enter
    inputCapitulo.addEventListener('keypress', (e) => {
      if (e.key === 'Enter') {
        cargarCapitulo(inputCapitulo.value);
      }
    });

    // Cargar el capítulo inicial al cargar la página
    document.addEventListener('DOMContentLoaded', () => {
      cargarCapitulo(inputCapitulo.value);
    });
  </script>
</body>
</html>