import sys
from PIL import Image, ImageEnhance, ImageFilter
import pytesseract
from pytesseract import image_to_string

# Configurar la ruta del ejecutable de Tesseract si no está en tu PATH
pytesseract.pytesseract.tesseract_cmd = '/usr/bin/tesseract'


def preprocess_image(image_path):
    img = Image.open(image_path)
    img = img.convert('L') # Convertir a escala de grises
    enhancer = ImageEnhance.Contrast(img)
    img = enhancer.enhance(2) # Aumentar el contraste
    img = img.filter(ImageFilter.MedianFilter()) # Aplicar filtro de mediana
    return img


def extract_text(img):
    try:
        # Especificar múltiples idiomas
        return image_to_string(img, lang='eng+spa+por')
    except Exception as e:
        return str(e)

if __name__ == '__main__':
    image_path = sys.argv[1]
    preprocessed_img = preprocess_image(image_path)
    print(extract_text(preprocessed_img))