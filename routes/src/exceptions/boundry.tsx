import React, { Component, ErrorInfo } from 'react';

class ErrorBoundary extends Component {
  state = {
    error: null,
    status: null,
  };

  static getDerivedStateFromError(error: Error) {
    return {
      error: error.message,
    };
  }

  componentDidCatch(error: Error, errorInfo: ErrorInfo) {
    console.error('Something bad happened!', error, errorInfo);
  }

  render() {
    if (this.state.error) {
      return (
        <div>
          <h1>Something went wrong :(</h1>
          <p>{this.state.error}</p>
        </div>
      );
    }
    return this.props.children;
  }
}

export default ErrorBoundary;
