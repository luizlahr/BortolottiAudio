class Util {
  public filter(fields: Array<string>, term: string, data: Array<any> = []) {
    if (term) {
      term = term.toLowerCase();
      return data.filter((item) => {
        let found = false;
        fields.forEach((field) => {
          const value = String(item[field]).toLowerCase();
          if (
            this.removeAccents(value).indexOf(term) > -1 ||
            value.indexOf(term) > -1
          ) {
            found = true;
          }
        });
        return found;
      });
    }
    return data;
  }

  public removeAccents(text: string) {
    let accents =
      'ÀÁÂÃÄÅàáâãäåßÒÓÔÕÕÖØòóôõöøÈÉÊËèéêëðÇçÐÌÍÎÏìíîïÙÚÛÜùúûüÑñŠšŸÿýŽž';
    let accentsOut =
      'AAAAAAaaaaaaBOOOOOOOooooooEEEEeeeeeCcDIIIIiiiiUUUUuuuuNnSsYyyZz';
    const splitedText = text.split('');
    splitedText.forEach((letter, index) => {
      let i = accents.indexOf(letter);
      if (i != -1) {
        splitedText[index] = accentsOut[i];
      }
    });
    return splitedText.join('');
  }

  public formatValue(value: number): string {
    return Intl.NumberFormat('pt-BR', {
      style: 'currency',
      currency: 'BRL',
    }).format(value);
  }
}

export default new Util();
