describe('Typing a name into the name input', function() {
  it('should display a greeting containing the inputted name', function() {
    browser.get('/#/');

    var greeting = element(by.tagName('h2'));

    expect(greeting.getText()).toEqual('Welcome to the Site!');
  });
});