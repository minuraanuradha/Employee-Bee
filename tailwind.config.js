/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
  "./resources/views/**/*.{html,js,php}",
  "./public/**/*.{html,js,php}",
  "./public/test.php" 
  ],
  theme: {
    extend: {
      colors: {
        orange: '#FF3F00',
        black: '#161616',
        darkgray: '#52555A',
        lightgray: '#999DA6',
        white: '#DCDCDC',
        'lightgray-hover': '#80858E' // Darker shade of lightgray for hover
      },
      fontFamily: {
        roboto: ['Roboto Flex', 'sans-serif']
      },
      fontSize: {
        'h1': '5rem',
        'h2': '3rem',
        'h3': '2.5rem',
        'h4': '2.5rem',
        'h5': '1.5rem',
        'h6': '0.8rem',
        'p-regular': '0.8rem',
        'p-small': '0.7rem'
      },
      fontWeight: {
        'h1': '700',
        'h2': '500',
        'h3': '700',
        'h4': '300',
        'h5': '700',
        'h6': '700',
        'p-regular': '400',
        'p-small': '300'
      }
    }
  },
  plugins: [
    function ({ addUtilities }) {
      const textStyles = {
        '.text-h1': {
          fontSize: '2.7rem',
          fontWeight: '700',
          fontFamily: 'Roboto Flex, sans-serif',
          color: '#DCDCDC', // White
          letterSpacing: 'normal',
          '@screen sm': {
            fontSize: '4rem'
          },
          '@screen md': {
            fontSize: '5rem'
          }
        },
        '.text-h2': {
          fontSize: '2.7rem',
          fontWeight: '500',
          fontFamily: 'Roboto Flex, sans-serif',
          color: '#DCDCDC', // White
          letterSpacing: 'normal',
          '@screen sm': {
            fontSize: '3rem'
          },
          '@screen md': {
            fontSize: '4rem'
          }
        },
        '.text-h3': {
          fontSize: '2.5rem',
          fontWeight: '700',
          fontFamily: 'Roboto Flex, sans-serif',
          color: '#DCDCDC', // White
          letterSpacing: 'normal',
          '@screen sm': {
            fontSize: '2.5rem'
          },
          '@screen md': {
            fontSize: '2.5rem'
          }
        },
        '.text-h4': {
          fontSize: '2.5rem',
          fontWeight: '300',
          fontFamily: 'Roboto Flex, sans-serif',
          color: '#DCDCDC', // White
          letterSpacing: 'normal',
          '@screen sm': {
            fontSize: '2.5rem'
          },
          '@screen md': {
            fontSize: '2.5rem'
          }
        },
        '.text-h5': {
          fontSize: '1.5rem',
          fontWeight: '700',
          fontFamily: 'Roboto Flex, sans-serif',
          color: '#DCDCDC', // White
          letterSpacing: 'normal',
          '@screen sm': {
            fontSize: '1.5rem'
          },
          '@screen md': {
            fontSize: '1.5rem'
          }
        },
        '.text-h6': {
          fontSize: '0.8rem',
          fontWeight: '700',
          fontFamily: 'Roboto Flex, sans-serif',
          color: '#DCDCDC', // White
          letterSpacing: 'normal',
          '@screen sm': {
            fontSize: '0.8rem'
          },
          '@screen md': {
            fontSize: '0.8rem'
          }
        },
        '.text-p-regular': {
          fontSize: '0.8rem',
          fontWeight: '400',
          fontFamily: 'Roboto Flex, sans-serif',
          color: '#DCDCDC', // White
          letterSpacing: 'normal',
          '@screen sm': {
            fontSize: '0.8rem'
          },
          '@screen md': {
            fontSize: '0.8rem'
          }
        },
        '.text-p-small': {
          fontSize: '0.7rem',
          fontWeight: '300',
          fontFamily: 'Roboto Flex, sans-serif',
          color: '#DCDCDC', // White
          letterSpacing: 'normal',
          '@screen sm': {
            fontSize: '0.7rem'
          },
          '@screen md': {
            fontSize: '0.7rem'
          }
        }
      };

      const buttonStyles = {
        '.btn-1': {
          backgroundColor: '#FF3F00', // orange
          color: '#DCDCDC', // white
          fontSize: '0.8rem', // text-sm
          fontWeight: '500',
          padding: '0.4rem 2.25rem', // py-1.5 px-9
          borderRadius: '0.6rem', // rounded
          letterSpacing: '0.02em', // tracking-bit
          transition: 'all 0.3s ease', // transition-all
          fontFamily: 'Roboto Flex, sans-serif',
          '&:hover': {
            backgroundColor: '#CC3300' // Darker orange
          }
        },
        '.btn-2': {
          backgroundColor: '#DCDCDC', // white
          color: '#FF3F00', // orange
          fontSize: '0.8rem', // text-sm
          fontWeight: '500',
          padding: '0.4rem 2.25rem', // py-1.5 px-9
          borderRadius: '0.6rem', // rounded
          letterSpacing: '0.02em', // tracking-bit
          transition: 'all 0.3s ease',
          fontFamily: 'Roboto Flex, sans-serif',
          '&:hover': {
            backgroundColor: '#80858E' // lightgray-hover
          }
        },
        '.btn-3': {
          border: '1px solid #DCDCDC', // white
          color: '#DCDCDC', // white
          fontSize: '0.8rem', // text-sm
          fontWeight: '500',
          padding: '0.4rem 2.25rem', // py-1.5 px-9
          borderRadius: '0.6rem', // rounded
          letterSpacing: '0.02em', // tracking-bit
          transition: 'all 0.3s ease',
          fontFamily: 'Roboto Flex, sans-serif',
          '&:hover': {
            backgroundColor: '#DCDCDC', // white
            color: '#161616' // black
          }
        },
        '.btn-4': {
          border: '1px solid #FF3F00', // orange
          color: '#FF3F00', // orange
          fontSize: '0.8rem', // text-sm
          fontWeight: '500',
          padding: '0.4rem 2.25rem', // py-1.5 px-9
          borderRadius: '0.6rem', // rounded
          letterSpacing: '0.02em', // tracking-bit
          transition: 'all 0.3s ease',
          fontFamily: 'Roboto Flex, sans-serif',
          '&:hover': {
            backgroundColor: '#FF3F00', // orange
            color: '#DCDCDC' // white
          }
        }
      };

      addUtilities({ ...textStyles, ...buttonStyles }, ['responsive', 'hover']);
    }
  ]
}